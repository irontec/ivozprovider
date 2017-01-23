#!/usr/bin/perl

#########################################
# INCLUDES & PRAGMAS
#########################################

use strict;
use v5.10;
use DBI;
no warnings;
use Gearman::Client;
use POSIX;

#########################################
# GLOBALS
#########################################

# Set start time
my $start_time = time();

# MySQL connection data
my $db = 'ivozprovider';
my $host = 'data.ivozprovider.local';
my $port = 3306;
my $user = 'kamailio';
my $pass = 'ironsecret';
my $dsn = "DBI:mysql:database=$db;host=$host;port=$port";

# Gearmand connection data
my @gearman_servers = ('jobs.ivozprovider.local:4730');
my $gearman_job = 'tarificateCalls';

# Connect to DB
my $dbh = DBI->connect($dsn, $user, $pass)
    or die "Couldn't connect to database: " . DBI->errstr;

# My needed variables

# my @STATFIELDS = qw {
#     id
#     proxy
#     start_time_utc
#     end_time_utc
#     start_time
#     end_time
#     duration
#     caller
#     callee
#     referrer
#     referee
#     callid
#     callidHash
#     xcallid
#     type
#     subtype
#     diversion
#     companyId
#     peeringContractId
#     parsed
#     direction
# };
#
# my @STATAUXFIELDS = qw {
#     legType
#     initialLeg
#     initialLegHash
#     xferdst
#     xfercid
# };

my @CDRFIELDS  = qw {
    statId
    xstatId
    statType
    initialLeg
    initialLegHash
    cidHash
    cid
    xcid
    xcidHash
    proxies
    type
    subtype
    calldate
    duration
    aParty
    bParty
    caller
    callee
    xCaller
    xCallee
    initialReferrer
    referrer
    referee
    lastForwarder
    brandId
    companyId
    peeringContractId
};

my %execution = (
    'pendingLegs' => 0,
    'groupedLegs' => 0,
    'ungroupedLegs' => 0,
    'completedGroups' => 0,
    'incompletedGroups' => 0,
    'generatedCDRs' => 0,
    'parsed-yes' => 0,
    'parsed-delayed' => 0,
    'taficableCalls' => 0,
);
my %cids;
my $cdrs = [];

#########################################
# SUBROUTINES
#########################################

sub logger {
    say "[$start_time] ", @_;
}

sub getDiversion {
    my $diversion = shift;
    return undef if not $diversion;

    if ($diversion =~ /\((\d+)\)/) {
        $diversion = $1;
    }
    return $diversion;
}

sub setCommon {
    my $cdr = shift;
    my $leg = shift;
    my $bleg = shift;

    $$cdr{brandId} = $$leg{brandId};
    $$cdr{companyId} = $$leg{companyId};
    $$cdr{initialLeg} = $$leg{initialLeg};
    $$cdr{initialLegHash} = $$leg{initialLegHash};
    $$cdr{statId} = $$leg{id};
    $$cdr{statType} = $$leg{legType};
    $$cdr{cid} = $$leg{callid};
    $$cdr{cidHash} = $$leg{callidHash};
    $$cdr{proxies} = $$leg{proxy};
    $$cdr{calldate} = $$leg{start_time_utc};
    $$cdr{duration} = $$leg{duration};
    $$cdr{caller} = $$leg{caller};
    $$cdr{callee} = $$leg{callee};
    $$cdr{lastForwarder} = getDiversion $$leg{diversion};
    $$cdr{peeringContractId} = $$leg{peeringContractId};
    $$cdr{direction} = $$leg{direction}; # See setCDRType

    if (!$bleg) {
        if ($$leg{legType} ne 'A') {
            # It is a C or D type

            # Single leg CDR entries C/D always start by user
            $$cdr{proxies} = 'USER-' . $$cdr{proxies};

            # C/D stats will use xcid to store A leg CID
            $$cdr{xcid} = $$leg{xcallid};
        }

        return;
    }

    # For blegs only
    $$cdr{proxies} = $$cdr{proxies} . '-' . $$bleg{proxy};
    $$cdr{statType} = $$cdr{statType} . '-' . $$bleg{legType};
    $$cdr{xstatId} = $$bleg{id};
    $$cdr{xcid} = $$bleg{callid};
    $$cdr{xcidHash} = $$bleg{callidHash};
    $$cdr{lastForwarder} = getDiversion $$bleg{diversion}; # On AB, A diversion is always discarded
    $$cdr{duration} = $$bleg{duration}; # On AB, B duration is the winner
    $$cdr{xCaller} = $$bleg{caller};
    $$cdr{xCallee} = $$bleg{callee};
    $$cdr{peeringContractId} = $$bleg{peeringContractId} || $$cdr{peeringContractId}; # If both AB, B is saved
                                                                                      # (entrante-saliente con facturacion de entrantes)

    # If peeringContractId is set, increase tarificable calls counter
    $execution{tarificableCalls}++ if $$cdr{peeringContractId};
}

sub updateCaller {
    my $prev_cdr = shift;

    if ($$prev_cdr{aParty} == $$prev_cdr{referrer}) {
        return $$prev_cdr{bParty};
    } elsif ($$prev_cdr{bParty} == $$prev_cdr{referrer}) {
        return $$prev_cdr{aParty};
    } else {
        logger "I cannot guess who is the caller and referrer, weird";
        return;
    }
}

sub getInitialReferrer {
    my $callid = shift;

    # Lookup call in kam_users_acc to get the real transferrer
    my $getExtension = "SELECT EXT.number FROM kam_users_acc KUA LEFT JOIN Terminals T on T.name=KUA.from_user LEFT JOIN Users U ON U.terminalId=T.id LEFT JOIN Extensions EXT ON EXT.Id=U.extensionId LEFT JOIN Companies C ON T.companyId=C.id where KUA.callid='$callid'";

    my $sth = $dbh->prepare($getExtension)
      or die "Couldn't prepare statement: $getExtension";
    $sth->execute()
      or die "Couldn't execute statement: $getExtension";

    my $extension = $sth->rows;

    if (not $extension) {
        logger "No extension found looking up in kam_users_acc, weird";
        return;
    }

    my $result = $sth->fetchrow_hashref;
    $sth->finish();

    return $$result{number};
}

sub semiattXfer {
    my $cdr = shift;
    my $leg = shift;
    my $prev_cdr = shift;

    $$prev_cdr{referee} = $$leg{diversion} || $$leg{callee};
    $$cdr{initialReferrer} = getInitialReferrer $$leg{xcallid};

    if ($$cdr{initialReferrer}) {
        $$prev_cdr{referrer} = $$cdr{initialReferrer};

        # In semi-att xfers, caller must be updated to show the real interlocutor
        if ($$prev_cdr{aParty} == $$cdr{initialReferrer}) {
            $$cdr{caller} = $$prev_cdr{bParty};
        } elsif ($$prev_cdr{bParty} == $$cdr{initialReferrer}) {
            $$cdr{caller} = $$prev_cdr{aParty};
        } else {
            logger "$$cdr{initialReferrer} was not the aParty nor the bParty, weird...";
        }
    }
}

sub blindXfer {
    my $cdr = shift;
    my $leg = shift;
    my $prev_cdr = shift;

    # Set referee
    $$prev_cdr{referee} = $$leg{diversion} || $$leg{callee};

    # C type has always reliable referrer (via Referred-By)
    $$prev_cdr{referrer} = $$leg{referrer};
    $$cdr{initialReferrer} = $$prev_cdr{referrer};

    # In blind xfers, caller might need to be changed to show the real interlocutor
    my $new_caller = updateCaller $prev_cdr;
    $$cdr{caller} = $new_caller if $new_caller;
}

sub attXfer {
    my $cdr = shift;
    my $leg = shift;
    my $prev_cdr = shift;

    # Set referrer/referee
    $$prev_cdr{referrer} = $$leg{caller};
    $$prev_cdr{referee} = $$leg{callee};
    $$cdr{initialReferrer} = $$prev_cdr{referrer};

    # In attxfers, caller must be updated to show the real interlocutor
    my $new_caller = updateCaller $prev_cdr;
    $$cdr{caller} = $new_caller if $new_caller;
}

sub getXferred {
    my $leg = shift;
    my $related = shift;

    if ($$leg{referee} =~ /sip:(.*)\@.*Replaces=(.*?)%40(.*?)%/) {
        $$leg{xferdst} = $1;
        $$leg{xfercid} = $2 . '@' . $3;
        $$related{$$leg{xfercid}}++;
    } elsif ($$leg{referee} =~ /sip:(.*)\@/) {
        $$leg{xferdst} = $1;
    }
}

sub deleteCDR {
    my $id = shift;

    return unless $id; # Safety check

    # Fetch already parsed related CDRs, if any
    my $deleteCDR = "DELETE FROM ParsedCDRs WHERE id='$id'";

    my $sth = $dbh->prepare($deleteCDR)
      or die "Couldn't prepare statement: $deleteCDR";
    $sth->execute() 
      or die "Couldn't execute statement: $deleteCDR";

    $sth->finish();

    logger "Delete CDR entry with id '$id'";
}

sub setParsedValue {
    my $id = shift;
    my $callidHash = shift;
    my $parsedValue = shift;

    # Update execution counters
    $execution{'parsed-' . $parsedValue}++;

    # Prepare query
    my $sql = "UPDATE kam_acc_cdrs SET parsed='$parsedValue' WHERE id='$id'";

    # Execute query
    my $sth = $dbh->prepare($sql)
          or die "Couldn't prepare statement: $sql";
    $sth->execute()
          or die "Couldn't execute statement: $sql";
    $sth->finish();

    logger "[$callidHash] Marked as '$parsedValue' (id: $id)";
}

sub isRealDleg {
    my $leg = shift;

    # Fetch already parsed related CDRs, if any
    my $getRelatedCDRs = "SELECT * FROM ParsedCDRs WHERE cid='$$leg{xcallid}'";

    my $sth = $dbh->prepare($getRelatedCDRs)
      or die "Couldn't prepare statement: $getRelatedCDRs";
    $sth->execute()
      or die "Couldn't execute statement: $getRelatedCDRs";

    my $RelatedCDRs = $sth->rows;

    if (not $RelatedCDRs) {
        return 1;
    }

    my $cdr = $sth->fetchrow_hashref;
    $sth->finish();

    logger "Leg with id '$$leg{id}' is not a real D leg (related leg id: $$cdr{statId})";

    deleteCDR $$cdr{id};
    setParsedValue $$cdr{statId}, $$cdr{cidHash}, 'no';

    return 0;
}

sub setLegType {
    my $leg = shift;
    my $newGroupCIDs = shift;

    if (!$$leg{xcallid}) {
        $$leg{legType} = 'A';
    } else {
        if (!$$newGroupCIDs{$$leg{xcallid}}) {
            # D type legs could be B legs with A legs previously treated as A-only legs :(
            if (isRealDleg $leg) {
                $$leg{legType} = 'D';
            } else {
                return;
            }
        } else {
            $$leg{legType} = ($$leg{referrer}) ? 'C' : 'B';
        }
    }

    return $$leg{legType};
}

sub setCdrType {
    my $cdr = shift;

    # Set type: interna / externa
    if ($$cdr{proxies} =~ /PSTN/) {
        $$cdr{type} = 'externa';
    } else {
        $$cdr{type} = 'interna';
    }

    # Set subtype for external calls: entrante, saliente, entrante-saliente
    given ($$cdr{proxies}) {
        when (/^USER-PSTN$/) { $$cdr{subtype} = 'saliente'; }
        when (/^PSTN-USER$/) { $$cdr{subtype} = 'entrante'; }
        when (/^PSTN-PSTN$/) { $$cdr{subtype} = 'entrante-saliente'; }
        when (/^PSTN$/) {
            # A-leg-only calls were distinguished using peeringContractId
            # Since inboundCallsBilling this must be done using direction
            if ($$cdr{direction} eq 'inbound') {
                $$cdr{subtype} = 'entrante';
            } else {
                $$cdr{subtype} = 'saliente';
            }
        }
    }
}

sub addLegToGroup {
    my $leg = shift;
    my %group = @_;

    $execution{groupedLegs}++; # Add to grouped leg counter

    # If leg has referee, add to counter
    push @{$group{referees}}, $$leg{callid} if $$leg{referee};

    # Set leg initial callid
    $$leg{initialLeg} = $group{initialLeg};
    $$leg{initialLegHash} = $group{initialLegHash};

    # Add callid to group
    $group{callids}{$$leg{callid}}++;
    $group{related}{$$leg{callid}}++;
    push $group{legs}, $leg;

    delete $cids{$$leg{key}};

    # Extract relations via attended xfers
    getXferred $leg, $group{related};
}

sub findRelatedLegs {
    my %group = @_;

    for my $cid (sort {$a <=> $b} keys %cids) {
        my $leg = $cids{$cid};
        if ($group{related}{$$leg{xcallid}} || $group{related}{$$leg{callid}}) {
            # Leg is somehow related to current group
            addLegToGroup $leg, %group;
        }
    }
}

# For A, C and D CDRs
sub generateSingleLegCdr {
    my $leg = shift;
    my $cdr = {};

    setCommon $cdr, $leg;

    # Set xfer specific stuff
    if ($$leg{legType} eq 'C') {
        blindXfer $cdr, $leg, $$cdrs[-1];
    } elsif ($$leg{legType} eq 'D') {
        semiattXfer $cdr, $leg, $$cdrs[-1];
    }

    # Set interlocutors
    $$cdr{aParty} = $$cdr{caller};
    $$cdr{bParty} = $$cdr{callee};

    setCdrType $cdr;

    push @$cdrs, $cdr;
}

# For AB CDRs
sub generateDualLegCdr {
    my $aleg = shift;
    my $bleg = shift;
    my $cdr = {};

    if ($$aleg{legType} ne 'A' || $$bleg{legType} ne 'B') {
        logger "Dual leg CDR can only be AB stats, we have $$aleg{legType} and $$bleg{legType} here (ids: $$aleg{id} $$bleg{id})";
    }

    setCommon $cdr, $aleg, $bleg;

    # Set xfer stuff if AB is dued to att-xfer
    if ($$aleg{callid} ne $$aleg{initialLeg}) {
        attXfer $cdr, $aleg, $$cdrs[-1];
    }

    # Set interlocutors
    $$cdr{aParty} = $$cdr{caller};
    $$cdr{bParty} = $$cdr{xCallee};

    setCdrType $cdr;

    push @$cdrs, $cdr;
}

sub isAlreadyGrouped {
    my $groups = shift;
    my $callid = shift;

    # Skip already grouped
    for my $gr (@$groups) {
        for my $leg (@$gr) {
            return 1 if $$leg{callid} eq $callid;
        }
    }
    return 0;
}

sub groupIsCompleted {
    my %group = @_;

    # Check if group is incompleted

    # Rule 1: if number of legs equals number of legs with referee, incompleted
    if (@{$group{legs}} == @{$group{referees}}) {
        my @legs_ids;
        push @legs_ids, $$_{id} for (@{$group{legs}});
        logger "Group is incomplete, same number of referees than legs (ids: @legs_ids)";
        return 0;
    }

    # Rule 2: if more than 1 leg, there is no A without B (and viceversa)
    if (@{$group{legs}} > 1) {
        if (@{$group{alegs}} != @{$group{blegs}}) {
            my @legs_ids;
            push @legs_ids, $$_{id} for (@{$group{legs}});
            logger "Group is incomplete, A without B or B without A (ids: @legs_ids)";
            return 0;
        }
    }

    return 1;
}

sub insertCDR {
    my $cdr = shift;

    # Prepare INSERT query
    my $fields = join ',', map {"`$_`"} @CDRFIELDS;
    my $values = join ',', map {
        if ($$cdr{$_}) {
            "'$$cdr{$_}'";
        } else {
            "NULL";
        }
    } @CDRFIELDS;

    my $insertStat = "INSERT INTO ParsedCDRs ($fields) VALUES ($values)";

    # Insert new row to ParsedCDRs
    my $sth = $dbh->prepare($insertStat)
          or die "Couldn't prepare statement: $insertStat";
    $sth->execute()
          or die "Couldn't execute statement: $insertStat";
    $sth->finish();

    # Print values and set parsed value
    if ($$cdr{xcidHash}) {
        logger "[$$cdr{initialLegHash}][$$cdr{cidHash}][$$cdr{xcidHash}] $_ => $$cdr{$_}" for @CDRFIELDS;
        setParsedValue $$cdr{statId}, $$cdr{cidHash}, 'yes';
        setParsedValue $$cdr{xstatId}, $$cdr{xcidHash}, 'yes' if $$cdr{xcidHash};
    } else {
        logger "[$$cdr{initialLegHash}][$$cdr{cidHash}] $_ => $$cdr{$_}" for @CDRFIELDS;
        setParsedValue $$cdr{statId}, $$cdr{cidHash}, 'yes';
    }
}

#########################################
# MAIN LOGIC
#########################################

logger "Execution started at " . localtime();

# Fetch oldest unparsed calls
my $getPendingStats = "SELECT c.*, com.brandId FROM kam_acc_cdrs c LEFT JOIN Companies com ON com.id=c.companyId WHERE parsed!='yes' ORDER BY start_time";

my $sth = $dbh->prepare($getPendingStats)
  or die "Couldn't prepare statement: $getPendingStats";
$sth->execute()
  or die "Couldn't execute statement: $getPendingStats";

$execution{pendingLegs} = $sth->rows;

if (not $execution{pendingLegs}) {
    logger "No pending stats";
    logger "Execution ended at " . localtime();
    exit;
}

logger "Pending stats: $execution{pendingLegs}";

# Get pending stats
my $alegs = [];

for (my $i=1; my $leg = $sth->fetchrow_hashref; $i++) {
    $cids{$i} = $leg;
    $$leg{key} = $i;
    push @$alegs, $leg if not $$leg{xcallid};
}

$sth->finish();

# Log oldest stat
logger "Oldest stat was inserted at $cids{1}{start_time_utc} (id: $cids{1}{id})";

# Create groups of related legs
my $groups = [];
my $group_candidates = [];
for my $aleg (@$alegs) {
    next if isAlreadyGrouped $group_candidates, $$aleg{callid};

    # New group
    my %group;
    $group{callids} = {};
    $group{referees} = [];
    $group{related} = {};
    $group{legs} = [];
    $group{alegs} = [];
    $group{blegs} = [];
    $group{initialLeg} = $$aleg{callid};
    $group{initialLegHash} = $$aleg{callidHash};
    $group{reparsing} = 0;

    # Add aleg to a new group
    addLegToGroup $aleg, %group;

    # Find legs related with this new group
    findRelatedLegs %group;

    # Add legType for each leg in new group (A, B, C, D)
    for my $leg (@{$group{legs}}) {
        my $type = setLegType $leg, $group{callids};
        if (not $type) {
            logger "One already inserted CDR stat was detected as this group member";
            $group{reparsing} = 1;
        }
        push @{$group{alegs}}, $$leg{callid} if $type eq 'A';
        push @{$group{blegs}}, $$leg{callid} if $type eq 'B';
    }

    # Add to group_candidates even if it is incompleted or reparsing done
    push @$group_candidates, $group{legs};

    # If any CDR stat needs reparsing, skip group
    if ($group{reparsing}) {
        logger "Not processing this group in this run";
        next;
    }

    # Check if group is incompleted
    if (not groupIsCompleted %group) {
        $execution{incompletedGroups}++;
        next;
    }

    push @$groups, $group{legs};
}

# Log formed groups stats
$execution{completedGroups} = @$groups;
logger "Formed groups: $execution{completedGroups}";
logger "Grouped stats: $execution{groupedLegs}";
$execution{ungroupedLegs} = scalar keys %cids;
my @ungrouped;
for (keys %cids) {
    push @ungrouped, $cids{$_}{id};
}
@ungrouped = sort {$a <=> $b} @ungrouped;
logger "Ungrouped stats: $execution{ungroupedLegs} (@ungrouped)";
logger "Incompleted skipped groups: $execution{incompletedGroups}";

# Parse groups and generate CDR entries
for my $legs (@$groups) {
    # Generate A(-B) CDR
    my $aleg;
    my $bleg;
    if (@$legs == 1) {
        $aleg = shift @$legs;
        if ($$aleg{parsed} eq 'delayed') {
            generateSingleLegCdr $aleg;
        } else {
            # A leg only stats wait for 1 run to avoid errors in mid-inserted AB stats
            setParsedValue $$aleg{id}, $$aleg{callidHash}, 'delayed';
        }
    } else {
        $aleg = shift @$legs;
        $bleg = shift @$legs;
        generateDualLegCdr $aleg, $bleg;
    }

    # Generate remaining CDR(s), if any
    while (@$legs) {
        my $leg = shift @$legs;

        if ($$leg{legType} eq 'C' || $$leg{legType} eq 'D') {
            generateSingleLegCdr $leg;
        } else {
            my $nextLeg = shift @$legs;
            if ($$leg{legType} eq 'A') {
                generateDualLegCdr $leg, $nextLeg;
            } else { # B
                generateDualLegCdr $nextLeg, $leg;
            }
        }
    }
}

# Log generated CDR stats
$execution{generatedCDRs} = @$cdrs;
logger "Generated CDR entries: $execution{generatedCDRs}";

# Insert generated CDRs to DB
insertCDR($_) for @$cdrs;

# Log final stats
logger "Stats marked as parsed: $execution{'parsed-yes'}";
logger "Stats marked as delayed: $execution{'parsed-delayed'}";

# Disconnect from database
$dbh->disconnect;

# Call tarificator if necessary
$execution{tarificableCalls} = 0 unless $execution{tarificableCalls};
logger "Tarificable calls on this run: $execution{tarificableCalls}";
if ($execution{tarificableCalls}) {
    # Call Gearmand tarificator Job
    my $client = Gearman::Client->new;
    $client->job_servers(@gearman_servers);
    $client->do_task($gearman_job);
}

# Report finish time and leave
logger "Execution ended at " . localtime();
exit;

