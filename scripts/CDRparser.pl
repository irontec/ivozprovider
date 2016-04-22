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
###    SELECT proxy, callid FROM CDRs WHERE xcallid='' AND duration!='0' AND parsed='no';
###    
###    Parseamos cada callid:
###    
###    - Si es de proxyusers:
###    
###    -- El valor de callid aparece como xcallid en otro registro?
###    
###    SELECT * FROM CDRs WHERE xcallid='$CURRENT_CALLID' AND duration!='0';
###
###    (A) Si, en un registro de proxyusers: LLAMADA INTERNA.
###    
###    (B) Si, en un registro de proxytrunks:
###        Comprobar type-subtype de aleg:
###        (B1) Si es externa-saliente: LLAMADA SALIENTE EXTERNA PURA.
###        (B2) Si es interna-saliente: LLAMADA SALIENTE EXTERNA POR DESVIO DE USUARIO.
###    
###    (C) No: LLAMADA DE USUARIO QUE MUERE EN AS (voicemail, etc.)
###    
###    - Si es de proxytrunks:
###    
###    -- El valor de callid aparece como xcallid en otro registro?
###    
###    SELECT * FROM CDRs WHERE xcallid='$CURRENT_CALLID' AND duration!='0';
###    
###    (D) Si, en un registro de proxyusers: LLAMADA ENTRANTE EXTERNA QUE ACABA EN USUARIO.
###    
###    (E) Si, en un registro de proxytrunks: LLAMADA ENTRANTE EXTERNA DESVIADA A NUMERO EXTERNO.
###        Evaluar diferencia entre desvio de DID o de usuario.
###        En base al valor del Diversion, puedo saber si es uno u otro:
###        (E1) Si 'Dialed number' es igual a diversion: DESVIO DE DID.
###        (E2) Si no, DESVIO DE USUARIO.
###    
###    (F) No: LLAMADA ENTRANTE EXTERNA QUE MUERE EN AS (voicemail, etc.)
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
###     oasis_forwarder (el desviador de desvios de OASIS)
###     forward_to (user/pstn: desvios de oasis, a donde se desvia)
###     companyId
###     brandId
###     aleg
###     bleg

#########################################
# INCLUDES & PRAGMAS
#########################################

use strict;
use v5.10;
use DBI;
no warnings;
use Data::Dumper;
use Gearman::Client;
use POSIX;

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
my @gearman_servers = ('portals:4730');
my $gearman_job = 'tarificateCalls';

# Connect to DB
my $dbh = DBI->connect($dsn, $user, $pass)
                or die "Couldn't connect to database: " . DBI->errstr;

# My needed variables
my @STATFIELDS = qw /calldate src src_dialed src_duration dst dst_src_cid dst_duration type desc fw_desc ext_forwarder oasis_forwarder forward_to companyId brandId aleg bleg/;
my %stat; # Has containing keys referred in @STATFIELDS and aditional stuff not inserted in stat
my %execution = ('ok' => 0, 'error' => 0);

#########################################
# SUBROUTINES
#########################################

sub setBlegInfo {
    my $callid = $stat{callid};
    
    my $get_bleg = "SELECT * from CDRs WHERE xcallid='$callid' AND duration!='0'";
    my $sth = $dbh->prepare($get_bleg)
                or die "Couldn't prepare statement: $get_bleg";
    $sth->execute() 
          or die "Couldn't execute statement: $get_bleg";

    if ($sth->rows > 1) {
        warn "[$callid] Has multiple blegs, skip\n";
        return undef;
    }

    if ($sth->rows == 1) {
        my $bleg = $sth->fetchrow_hashref;
        say "[$callid] Has unique bleg: $$bleg{callid}";
        say "[$callid] bleg is from $$bleg{proxy}";

        # Set bleg stuff
        $stat{bleg} = $$bleg{callid};
        $stat{dst_duration} = ceil $$bleg{duration};
        $stat{dst_src_cid} = $$bleg{caller};
        $stat{dst} = $$bleg{callee};
        $stat{diversionB} = $$bleg{diversion};
 
        # Set aditional fields for future reference (not used in INSERT)
        $stat{proxyB} = $$bleg{proxy};
    } else {
        say "[$callid] Has NO bleg";
        $stat{proxyB} = 'none';
    }

    return 1;
}

sub setCallType {
    # Tipos posibles:
    #    USER-USER: Llama un usuario y acaba hablando con otro usuario
    #    USER-PBX: Llama un usuario y la llamada muere en el AS
    #    USER-PSTN: Llama un usuario a un numero de la PSTN
    #    USER->PSTN: Llama un usuario a otro usuario y acaba hablando con un numero de la PSTN (desvio)
    #    PSTN-USER: Llamada externa entrante que acaba en un usuario
    #    PSTN-PBX: Llamada externa entrante que acaba en el AS
    #    PSTN->PSTN: Llamada externa entrante que acaba desviandose a un numero de la PSTN (desvio)

    given($stat{proxy} . '-' . $stat{proxyB}) {
        when (/proxyusers-proxyusers/) {
            $stat{type} = 'USER-USER';
            $stat{desc} = 'LLAMADA INTERNA';
        }
        when (/proxyusers-proxytrunks/) {
            if ($stat{subtypeA} eq 'interna') {
                $stat{type} = 'USER->PSTN';
                $stat{desc} = 'LLAMADA SALIENTE EXTERNA POR DESVIO DE USUARIO';
            } else {
                $stat{type} = 'USER-PSTN';
                $stat{desc} = 'LLAMADA SALIENTE EXTERNA PURA';
            }
        }
        when (/proxyusers-none/) {
            $stat{type} = 'USER-PBX';
            $stat{desc} = 'LLAMADA DE USUARIO QUE MUERE EN AS';
        }
        when (/proxytrunks-proxyusers/) {
            $stat{type} = 'PSTN-USER';
            $stat{desc} = 'LLAMADA ENTRANTE EXTERNA QUE ACABA EN USUARIO';
        }
        when (/proxytrunks-proxytrunks/) {
            $stat{type} = 'PSTN->PSTN';
            my $fw_type = ($stat{diversionB} eq $stat{src_dialed}) ? '(DESVIO DID)' : 'DESVIO USUARIO';
            $stat{desc} = 'LLAMADA ENTRANTE EXTERNA DESVIADA A NUMERO EXTERNO ' . $fw_type;
        }
        when (/proxytrunks-none/) {
            $stat{type} = 'PSTN-PBX';           
            $stat{desc} = 'LLAMADA ENTRANTE EXTERNA QUE MUERE EN AS';           
        }
    }
    say "[$stat{callid}] Tipo: $stat{type}";
    say "[$stat{callid}] Desc: $stat{desc}";
}

sub parseForward {
    unless ($stat{diversionA} or $stat{diversionB}) {
        say "[$stat{callid}] Desvio: no";
    } 

    if ($stat{diversionA}) {
        if ($stat{proxy} eq 'proxyusers') {
            warn "[$stat{callid}] Llamada de un terminal con Diversion seteado, error\n"; 
            return undef;
        } else {
            say "[$stat{callid}] Desvio: desvio de PSTN ajeno a Oasis";
            $stat{ext_forwarder} = $stat{diversionA};
            $stat{fw_desc} = 'Desvio de PSTN ajeno a Oasis';
        }
    }

    if ($stat{diversionB}) {
        $stat{oasis_forwarder} = $stat{diversionB};
        if ($stat{proxyB} eq 'proxyusers') {
            say "[$stat{callid}] Desvio: desvio de Oasis a usuario"; 
            $stat{forward_to} = 'user';
            $stat{fw_desc} = "Desvio de Oasis a usuario";
        } else {
            say "[$stat{callid}] Desvio: desvio de Oasis a PSTN"; 
            $stat{forward_to} = 'pstn';
            $stat{fw_desc} = 'Desvio de Oasis a PSTN';
        }
    }

    return 1;
}

sub setParsedValue {
    my $value = shift;

    my $proxy = $stat{proxy};
    my $callid = $stat{callid};

    # Update execution counters
    $execution{ok}++ if $value eq 'yes';
    $execution{error}++ if $value eq 'error';

    # Prepare query
    my $table = ($proxy eq 'proxyusers') ? 'kam_users_acc_cdrs' : 'kam_trunks_acc_cdrs';
    my $markAsParsed = "UPDATE $table SET parsed='$value' WHERE callid='$callid'";

    # Execute query
    my $sth = $dbh->prepare($markAsParsed)
                    or die "Couldn't prepare statement: $markAsParsed";
    $sth->execute() 
          or die "Couldn't execute statement: $markAsParsed";

    say "[$callid] Marked as '$value'";
}

sub insertStat {
    # Prepare INSERT query
    my $fields = join ',', map {"`$_`"} @STATFIELDS;
    my $values = join ',', map {"'$stat{$_}'"} @STATFIELDS;

    my $insertStat = "INSERT INTO ParsedCDRs ($fields) VALUES ($values)";

    # Print values
    say "[$stat{aleg}] $_ => $stat{$_}" for @STATFIELDS;

    # Insert new row to ParsedCDRs
    my $sth = $dbh->prepare($insertStat)
                    or die "Couldn't prepare statement: $insertStat";
    $sth->execute() 
          or die "Couldn't execute statement: $insertStat";
}


#########################################
# MAIN LOGIC
#########################################

# Fetch unparsed calls (only alegs with duration > 0)
my $getPendingCalls = "SELECT c.*, com.brandId FROM CDRs c LEFT JOIN Companies com ON com.id=c.companyId WHERE xcallid='' AND duration!='0' AND parsed='no' ORDER BY start_time";

my $sth = $dbh->prepare($getPendingCalls)
                or die "Couldn't prepare statement: $getPendingCalls";

$sth->execute() 
      or die "Couldn't execute statement: $getPendingCalls";

my $pendingCallsNumber = $sth->rows;

if (not $pendingCallsNumber) {
    say "No pending calls";
    exit;
}

say "There are $pendingCallsNumber pending calls";

while (my $call = $sth->fetchrow_hashref) {
    %stat = ();

    # Set aleg stuff
    $stat{aleg} = $$call{callid};
    $stat{calldate} = $$call{calldate};
    $stat{src_duration} = ceil $$call{duration};
    $stat{src} = $$call{caller};
    $stat{src_dialed} = $$call{callee};
    $stat{diversionA} = $$call{diversion};
    
    # Set generic stuff
    $stat{companyId} = $$call{companyId};
    $stat{brandId} = $$call{brandId};

    # Set aditional fields for future reference (not used in INSERT)
    $stat{proxy} = $$call{proxy};
    $stat{callid} = $$call{callid};
    $stat{subtypeA} = $$call{subtype};

    my $originator = ($stat{proxy} eq 'proxyusers') ? 'user' : 'external caller';
    say "[$stat{callid}] Parse call originated by $originator";

    setBlegInfo or setParsedValue 'error' and next;
    setCallType;
    parseForward or setParsedValue 'error' and next;
    insertStat;
    setParsedValue 'yes';

    say Dumper \%stat if @ARGV;
}

# Disconnect from database
$dbh->disconnect;

# Call Gearmand trarificator Job
my $client = Gearman::Client->new;
$client->job_servers(@gearman_servers);
$client->do_task($gearman_job);

say "Execution ended: $execution{ok} ok, $execution{error} error (total: $pendingCallsNumber)";
exit;

