#!/usr/bin/perl

#########################################
# README
#########################################

###    # Solo tenemos en cuenta en cada run las no parseadas con xcallid=NULL
###    # (las que tengan xcallid seran arrastradas por las que no lo tengan,
###    # no es posible que haya una entrada con xcallid sin que su valor salga
###    # en otra entrada como callid).
###
###    # IMPORTANTE: solo se tienen en cuenta llamadas establecidas (duration!=0)
###                  Se descartan llamadas canceladas y patas de ringall no contestadas, entre otras
###
###    
###    Query:
###    SELECT proxy, callid FROM kam_acc_cdrs WHERE xcallid='' AND duration!='0' AND parsed='no';
###    
###    Parseamos cada callid:
###    
###    - Si es de proxyusers:
###    
###    -- El valor de callid aparece como xcallid en otro registro?
###    
###    SELECT * FROM kam_acc_cdrs WHERE xcallid='$CURRENT_CALLID' AND duration!='0';
###
###    (A) Si, en un registro de proxyusers: LLAMADA DE USUARIO QUE ACABA EN USUARIO
###    
###    (B) Si, en un registro de proxytrunks: LLAMADA DE USUARIO QUE ACABA EN PSTN
###    
###    (C) No:
###       (C1) typeA == saliente: LLAMADA DE USUARIO QUE ACABA EN AS
###       (C2) typeA == entrante: LLAMADA DE AS QUE ACABA EN USUARIO (no contemplado a 2016/05/16)
###    
###    - Si es de proxytrunks:
###    
###    -- El valor de callid aparece como xcallid en otro registro?
###    
###    SELECT * FROM kam_acc_cdrs WHERE xcallid='$CURRENT_CALLID' AND duration!='0';
###    
###    (D) Si, en un registro de proxyusers: LLAMADA ENTRANTE EXTERNA QUE ACABA EN USUARIO
###    
###    (E) Si, en un registro de proxytrunks: LLAMADA ENTRANTE EXTERNA QUE ACABA EN PSTN
###    
###    (F) No: LLAMADA ENTRANTE EXTERNA QUE ACABA EN AS
###    (F) No:
###       (F1) typeA == entrante: LLAMADA DE PSTN QUE ACABA EN AS
###       (F2) typeA == saliente: LLAMADA DE AS QUE ACABA EN PSTN (unico caso comtemplado a 2016/05/16: fax)
###    
###    Una vez finalizado todo:
###    UPDATE kam_{users,trunks}_acc_cdrs SET parsed='yes' WHERE callid='$CURRENT_CALLID';
###    
###    Si error en algun punto:
###    UPDATE kam_{users,trunks}_acc_cdrs SET parsed='error' WHERE callid='$CURRENT_CALLID';
###    
###     
###     FORMATO TABLA FINAL: ParsedCDR    
###     
###     calldate (es el calldate de la pata A, el de la pata B podria obtenerse con las duraciones)
###     src (Real Caller)
###     src_dialed (Dialed number)
###     src_duration (Duracion pata A)
###     dst (Final Callee)
###     dst_src_cid (Shown number to final callee)
###     dst_duration (Duracion pata B)
###     type (ahora mismo 7 casos)
###     desc (detalla el tipo con una frase descriptiva)
###     fw_desc (detalla el tipo de desvio con una frase descriptiva)
###     ext_forwarder (si nos entra una llamada con un desvio ajeno, el desviador se guarda aqui)
###     int_forwarder (si hay un desvio dentro de nuestra plataforma, el desviador se guarda aqui)
###     forward_to (numero llamado a raiz del desvio)
###     companyId
###     brandId
###     aleg
###     bleg
###     billCallID: si llamada facturable, tendra el valor de aleg/bleg (la pata facturable)
###     peeringContractId: si llamada saliente, tendra el id del PeeringContract por el que haya salido

#########################################
# INCLUDES & PRAGMAS
#########################################

use strict;
use v5.10;
use DBI;
no warnings;
use Gearman::Client;
use POSIX;
use Data::Dumper;

#########################################
# GLOBALS
#########################################

# MySQL connection data
my $db = 'ivozprovider';
my $host = '127.0.0.1';
my $port = 3306;
my $user = 'kamailio';
my $pass = 'ironsecret';
my $dsn = "DBI:mysql:database=$db;host=$host;port=$port";

# Gearmand connection data
my @gearman_servers = ('jobs:4730');
my $gearman_job = 'tarificateCalls';

# Connect to DB
my $dbh = DBI->connect($dsn, $user, $pass)
                or die "Couldn't connect to database: " . DBI->errstr;

# Max calls to parse on each run
my $MAXCALLS = 100;

# My needed variables
my @STATFIELDS = qw /type desc calldate src src_dialed src_duration dst dst_src_cid dst_duration fw_desc ext_forwarder int_forwarder forward_to referrer referee companyId brandId aleg bleg cleg billCallID billDuration billDestination peeringContractId/;
my %execution = ('ok' => 0, 'error' => 0);

my @stats; # Array to hashrefs, one per insert in ParsedCDRs
my $ids; # Ref to array with IDs in kam_acc_cdrs

#########################################
# SUBROUTINES
#########################################

sub setBlegInfo {
    my $stat = shift;

    my $callid = $$stat{callid};

    # Real blegs would not have referrer field
    my $get_bleg = "SELECT * from kam_acc_cdrs WHERE xcallid='$callid' AND referrer='' AND duration!='0'";
    my $sth = $dbh->prepare($get_bleg)
          or die "Couldn't prepare statement: $get_bleg";
    $sth->execute() 
          or die "Couldn't execute statement: $get_bleg";

    if ($sth->rows > 1) {
        warn "[$callid] Has multiple blegs, error\n";
        while (my $bleg = $sth->fetchrow_hashref) {
            say "[$callid] bleg: $$bleg{callid} ($$bleg{id})";
            push @$ids, $$bleg{id};
        }
        return 1;
    }

    if ($sth->rows == 1) {
        my $bleg = $sth->fetchrow_hashref;
        say "[$callid] Has unique bleg: $$bleg{callid} ($$bleg{id})";
        say "[$callid] bleg is from $$bleg{proxy}";

        push @$ids, $$bleg{id};

        # Set bleg stuff
        $$stat{bleg} = $$bleg{callid};
        $$stat{dst_duration} = ceil $$bleg{duration};
        $$stat{dst_src_cid} = $$bleg{caller};
        $$stat{dst} = $$bleg{callee};
        $$stat{diversionB} = $$bleg{diversion};
 
        # Set aditional fields for future reference (not used in INSERT)
        $$stat{proxyB} = $$bleg{proxy};
        $$stat{peeringContractId} = $$bleg{peeringContractId} if $$bleg{peeringContractId};
        $$stat{refereeB} = $$bleg{referee};
    } else {
        say "[$callid] Has NO bleg";
        $$stat{proxyB} = 'none';
    }

    return 0;
}

sub setAlegData {
    my $call = shift;
    my $stat = shift;

    push @$ids, $$call{id};
    # Set aleg stuff
    $$stat{aleg} = $$call{callid};
    $$stat{calldate} = $$call{start_time};
    $$stat{src_duration} = ceil $$call{duration};
    $$stat{src} = $$call{caller};
    $$stat{src_dialed} = $$call{callee};
    $$stat{diversionA} = $$call{diversion};

    # Set generic stuff
    $$stat{companyId} = $$call{companyId};
    $$stat{brandId} = $$call{brandId};

    # Set aditional fields for future reference (not used in INSERT)
    $$stat{proxy} = $$call{proxy};
    $$stat{callid} = $$call{callid};
    $$stat{typeA} = $$call{type}; # entrante / saliente
    $$stat{subtypeA} = $$call{subtype}; # interna / externa (proxyusers) - fax / normal (proxytrunks)
    $$stat{peeringContractId} = $$call{peeringContractId} if $$call{peeringContractId};
    $$stat{referrerA} = $$call{referrer};
    $$stat{refereeA} = $$call{referee};
}

sub parseClegs {
    my $callid = shift;

    # Get calls generated with REFERs from initial call (or its bleg)
    my $get_clegs = "SELECT c.*, com.brandId FROM kam_acc_cdrs c LEFT JOIN Companies com ON com.id=c.companyId WHERE xcallid='$callid' AND referrer!='' AND duration!='0' ORDER BY start_time";

    my $sth = $dbh->prepare($get_clegs)
          or die "Couldn't prepare statement: $get_clegs";
    $sth->execute() 
          or die "Couldn't execute statement: $get_clegs";

    my $cleg_num = $sth->rows;
    say "[$callid] Has $cleg_num clegs";

    while (my $call = $sth->fetchrow_hashref) {
        my $stat = {};

        say "[$callid] cleg: $$call{callid} ($$call{id})";

        # Clegs are treated as aleg only calls
        setAlegData($call, $stat);

        # Custom stuff for C legs
        $$stat{aleg} = $callid;
        $$stat{cleg} = $$call{callid};

        push @stats, $stat;
    }
}

# FIXME Llamadas para clegs??
sub parseRefer {
    my $stat = shift;

    if ($$stat{referrerA}) {
        $$stat{referrer} = $$stat{referrerA};
        say "[$$stat{callid}] Call dued to a previous refer by $$stat{referrer}";
    } else {
        say "[$$stat{callid}] Call not dued to refer";
    }

    if ($$stat{refereeA} and $$stat{refereeB}) {
        $$stat{referee} = $$stat{refereeA} . '-' . $$stat{refereeB};
        $$stat{referrer} = $$stat{src} . '-' . $$stat{dst};
        say "[$$stat{callid}] Both aleg and bleg refer the call";
    } elsif ($$stat{refereeA}) {
        $$stat{referee} = $$stat{refereeA};
        $$stat{referrer} = $$stat{src};
        say "[$$stat{callid}] aleg refers the call to $$stat{referee}";
    } elsif ($$stat{refereeB}) {
        $$stat{referee} = $$stat{refereeB};
        $$stat{referrer} = $$stat{dst};
        say "[$$stat{callid}] bleg refers the call to $$stat{referee}";
    } else {
        say "[$$stat{callid}] Not referred anywhere";
    }
}

sub setCallType {
    my $stat = shift;

    if ($$stat{cleg}) {
        $$stat{proxyB} = 'none';
    }

    # Significado: param1 (delimiter) param2
    # param1:
    #    * donde nace la llamada
    #    * Valores posibles: USER, PSTN
    # delimiter:
    #    * Indica si la llamada ha tenido desvios o no (por parte de la plataforma)
    #    * Valores posibles: '-' (sin desvios) / '->' (con desvios)
    # param2:
    #    * donde acaba la llamada
    #    * Valores posibles: USER, PSTN, PBX

    given($$stat{proxy} . '-' . $$stat{proxyB}) {
        when (/proxyusers-proxyusers/) {
            $$stat{type} = 'USER-USER';
            $$stat{desc} = 'LLAMADA DE USUARIO QUE ACABA EN USUARIO';
        }
        when (/proxyusers-proxytrunks/) {
            $$stat{type} = 'USER-PSTN';
            $$stat{desc} = 'LLAMADA DE USUARIO QUE ACABA EN PSTN';
            $$stat{billCallID} = $$stat{bleg}; # Only billable calls will have this field
            $$stat{billDuration} = $$stat{dst_duration}; # Only billable calls will have this field
            $$stat{billDestination} = $$stat{dst}; # Only billable calls will have this field
        }
        when (/proxyusers-none/) {
            if ($$stat{typeA} eq 'saliente') {
                $$stat{type} = 'USER-PBX';
                $$stat{desc} = 'LLAMADA DE USUARIO QUE ACABA EN AS';
            } elsif ($$stat{typeA} eq 'entrante') {
                $$stat{type} = 'PBX-USER';
                $$stat{desc} = 'LLAMADA DE PBX QUE ACABA EN USUARIO';
            } else {
                say "[$$stat{callid}] Invalid typeA '$$stat{typeA}' (nor entrante/saliente), check!";
                return 1;
            }
        }
        when (/proxytrunks-proxyusers/) {
            $$stat{type} = 'PSTN-USER';
            $$stat{desc} = 'LLAMADA ENTRANTE EXTERNA QUE ACABA EN USUARIO';
        }
        when (/proxytrunks-proxytrunks/) {
            $$stat{type} = 'PSTN-PSTN';
            $$stat{desc} = 'LLAMADA ENTRANTE EXTERNA QUE ACABA EN PSTN';
            $$stat{billCallID} = $$stat{bleg}; # Only billable calls will have this field
            $$stat{billDuration} = $$stat{dst_duration}; # Only billable calls will have this field
            $$stat{billDestination} = $$stat{dst}; # Only billable calls will have this field
        }
        when (/proxytrunks-none/) {
            if ($$stat{typeA} eq 'entrante') {
                $$stat{type} = 'PSTN-PBX';
                $$stat{desc} = 'LLAMADA ENTRANTE EXTERNA QUE ACABA EN AS';
            } elsif ($$stat{typeA} eq 'saliente') {
                $$stat{type} = 'PBX-PSTN';
                $$stat{desc} = 'LLAMADA DE PBX QUE ACABA EN PSTN';
                if ($$stat{cleg}) {
                    $$stat{billCallID} = $$stat{cleg}; # Only billable calls will have this field
                } else {
                    $$stat{billCallID} = $$stat{aleg}; # Only billable calls will have this field
                }
                $$stat{billDuration} = $$stat{src_duration}; # Only billable calls will have this field
                $$stat{billDestination} = $$stat{src_dialed}; # Only billable calls will have this field
            } else {
                say "[$$stat{callid}] Invalid typeA '$$stat{typeA}' (nor entrante/saliente), check!";
                return 1;
            }
            $$stat{desc} = "$$stat{desc} ($$stat{subtypeA})" if $$stat{subtypeA} ne 'normal';
        }
    }

    if ($$stat{int_forwarder}) {
        $$stat{type} =~ s/-/->/;
        $$stat{desc} .= ' (DESVIADA)';
    }

    if ($$stat{cleg}) {
        $$stat{desc} .= ' (TRANSFERENCIA CIEGA)';
    }

    return 0;
}

# FIXME Llamadas para clegs??
sub parseForward {
    my $stat = shift;

    unless ($$stat{diversionA} or $$stat{diversionB}) {
        say "[$$stat{callid}] Desvio: no";
    } 

    if ($$stat{diversionA}) {
        if ($$stat{proxy} eq 'proxyusers') {
            warn "[$$stat{callid}] Llamada de un terminal con Diversion seteado, error\n"; 
            return 1;
        } else {
            say "[$$stat{callid}] Desvio: desvio de PSTN ajeno a la plataforma";
            $$stat{ext_forwarder} = $$stat{diversionA};
        }
    }

    if ($$stat{diversionB}) {
        if ($$stat{diversionB} eq $$stat{diversionA}) {
            say "[$$stat{callid}] bleg has the same diversion as aleg, skip parsing (AS has just resend it)";
            return 0;
        }

        $$stat{forward_to} = $$stat{dst};
        $$stat{int_forwarder} = $$stat{diversionB};

        if ($$stat{proxyB} eq 'proxyusers') {
            say "[$$stat{callid}] Desvio: $$stat{int_forwarder} desvia la llamada a numero interno $$stat{forward_to}"; 
            $$stat{fw_desc} = "$$stat{int_forwarder} desvia la llamada a numero interno $$stat{forward_to}";
        } else {
            # En desvio a PSTN, diversion contendra el DDI out del desviador y la extension desviadora
            say "[$$stat{callid}] Desvio: $$stat{int_forwarder} desvia la llamada a numero externo $$stat{forward_to}"; 
            $$stat{fw_desc} = "$$stat{int_forwarder} desvia la llamada a numero externo $$stat{forward_to}";
        }
    }

    return 0;
}

sub setParsedValue {
    my $mainCallId = shift;
    my $ids = shift;
    my $value = shift;

    # Update execution counters
    $execution{ok}++ if $value eq 'yes';
    $execution{error}++ if $value eq 'error';

    for (@$ids) {
        # Prepare query
        my $markAsParsed = "UPDATE kam_acc_cdrs SET parsed='$value' WHERE id='$_'";

        # Execute query
        my $sth = $dbh->prepare($markAsParsed)
              or die "Couldn't prepare statement: $markAsParsed";
        $sth->execute() 
              or die "Couldn't execute statement: $markAsParsed";

        say "[$mainCallId] Marked as '$value' (id: $_)";
    }
}

sub insertStat {
    my $stat = shift;

    # Prepare INSERT query
    my $fields = join ',', map {"`$_`"} @STATFIELDS;
    my $values = join ',', map {
        if ($$stat{$_}) {
            "'$$stat{$_}'";
        } else {
            "NULL";
        }
    } @STATFIELDS;

    my $insertStat = "INSERT INTO ParsedCDRs ($fields) VALUES ($values)";

    # Print values
    say "[$$stat{callid}] $_ => $$stat{$_}" for @STATFIELDS;

    # Insert new row to ParsedCDRs
    my $sth = $dbh->prepare($insertStat)
                    or die "Couldn't prepare statement: $insertStat";
    $sth->execute() 
          or die "Couldn't execute statement: $insertStat";
}

sub callTarificator {
    my $client = Gearman::Client->new;
    $client->job_servers(@gearman_servers);
    $client->do_task($gearman_job);
}

#########################################
# MAIN LOGIC
#########################################

# Fetch oldest unparsed calls (only alegs with duration > 0) - 30" from its hangup
my $getPendingCalls = "SELECT c.*, com.brandId FROM kam_acc_cdrs c LEFT JOIN Companies com ON com.id=c.companyId WHERE xcallid='' AND duration!='0' AND parsed='no' AND (UNIX_TIMESTAMP(calldate) + 3) < UNIX_TIMESTAMP(NOW()) ORDER BY start_time";

my $sth = $dbh->prepare($getPendingCalls)
                or die "Couldn't prepare statement: $getPendingCalls";

$sth->execute() 
      or die "Couldn't execute statement: $getPendingCalls";

my $pendingCallsNumber = $sth->rows;

if (not $pendingCallsNumber) {
    say "No pending calls";
    exit;
}

if ($pendingCallsNumber > $MAXCALLS) {
    say "$MAXCALLS pending calls will be parsed this run (out of $pendingCallsNumber pending calls)";
} else {
    say "All $pendingCallsNumber pending calls will be parsed this run";
}

my $i = 0;
while (my $call = $sth->fetchrow_hashref) {
    my $stat = {};
    @stats = ();
    $ids = [];

    say "[$$call{callid}] Initial leg: $$call{callid} ($$call{id})";

    setAlegData($call, $stat);
    parseClegs $$stat{callid}; # Add cleg(s) to @stats (and its ids to @ids)

    if (setBlegInfo($stat)) {
        setParsedValue($$stat{callid}, $ids, 'error');
        next;
    }

    if ($$stat{proxyB} eq 'none' and $$stat{refereeA}) {
        say "[$$stat{callid}] Skip call, its bleg has not hangup yet";
        next;
    }

    push @stats, $stat; # Add aleg(-bleg)

    # @stats now has aleg(-bleg) + cleg(s)
    my $markAsError = 0;
    for my $stat (reverse @stats) {
        parseRefer($stat);
        if (parseForward($stat) or setCallType($stat)) {
            $markAsError = 1;
            last;
        }
    }

    if ($markAsError) {
        setParsedValue($$stat{callid}, $ids, 'error');
        next;
    }

    insertStat($_) for @stats;
    setParsedValue($$stat{callid}, $ids, 'yes');

    # Only parse $MAXCALLS on each run
    last if ++$i >= $MAXCALLS;
}

# Disconnect from database
$dbh->disconnect;

# Call Gearmand tarificator Job
callTarificator;

say "Execution ended: $execution{ok} ok, $execution{error} error (total: $pendingCallsNumber)";
exit;

