package Gearman::ResponseParser;
use strict;

# this is an abstract base class.  See:
#    Gearman::ResponseParser::Taskset  (for Gearman::Client, the sync version), or
#    Gearman::ResponseParser::Danga    (for Gearman::Client::Danga, the async version)

# subclasses should call this first, then add their own data in underscore members
sub new {
    my $class = shift;
    my %opts  = @_;
    my $src = delete $opts{'source'};
    die if %opts;

    my $self = bless {
        source => $src,  # the source object/socket that is primarily feeding this.
    }, $class;

    $self->reset;
    return $self;
}

sub source {
    my $self = shift;
    return $self->{source};
}

sub on_packet {
    my ($self, $packet, $parser) = @_;
    die "SUBCLASSES SHOULD OVERRIDE THIS";
}

sub on_error {
    my ($self, $errmsg, $parser) = @_;
    # NOTE: this interface will evolve.
    die "SUBCLASSES SHOULD OVERRIDE THIS";
}

sub reset {
    my $self = shift;
    $self->{header} = '';
    $self->{pkt}    = undef;
}

# don't override:
# FUTURE OPTIMIZATION: let caller say "you can own this scalarref", and then we can keep it
#  on the initial settin of $self->{data} and avoid copying into our own.  overkill for now.
sub parse_data {
    my ($self, $data) = @_;  # where $data is a scalar or scalarref to parse
    my $dataref = ref $data ? $data : \$data;

    my $err = sub {
        my $code = shift;
        $self->on_error($code);
        return undef;
    };

    while (my $lendata = length $$data) {

        # read the header
        my $hdr_len = length $self->{header};
        unless ($hdr_len == 12) {
            my $need = 12 - $hdr_len;
            $self->{header} .= substr($$dataref, 0, $need, '');
            next unless length $self->{header} == 12;

            my ($magic, $type, $len) = unpack( "a4NN", $self->{header} );
            return $err->("malformed_magic") unless $magic eq "\0RES";

            my $blob = "";
            $self->{pkt} = {
                type => Gearman::Util::cmd_name($type),
                len  => $len,
                blobref => \$blob,
            };
            next;
        }

        # how much data haven't we read for the current packet?
        my $need = $self->{pkt}{len} - length(${ $self->{pkt}{blobref} });
        # copy the MAX(need, have)
        my $to_copy = $lendata > $need ? $need : $lendata;

        ${$self->{pkt}{blobref}} .= substr($$dataref, 0, $to_copy, '');

        if ($to_copy == $need) {
            $self->on_packet($self->{pkt}, $self);
            $self->reset;
        }
    }

    if (defined($self->{pkt}) && length(${ $self->{pkt}{blobref} }) == $self->{pkt}{len}) {
        $self->on_packet($self->{pkt}, $self);
        $self->reset;
    }
}

# don't override:
sub eof {
    my $self = shift;

    $self->on_error("EOF");
    # ERROR if in middle of packet
}

# don't override:
sub parse_sock {
    my ($self, $sock) = @_;  # $sock is readable, we should sysread it and feed it to $self->parse_data

    my $data;
    my $rv = sysread($sock, $data, 128 * 1024);

    if (! defined $rv) {
        $self->on_error("read_error: $!");
        return;
    }

    # FIXME:  EAGAIN , EWOULDBLOCK

    if (! $rv) {
        $self->eof;
        return;
    }

    $self->parse_data(\$data);
}

1;
