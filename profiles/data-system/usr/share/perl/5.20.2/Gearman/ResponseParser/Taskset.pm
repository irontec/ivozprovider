package Gearman::ResponseParser::Taskset;

use strict;
use base 'Gearman::ResponseParser';
use Gearman::Taskset;

sub new {
    my ($class, %opts) = @_;
    my $ts = delete $opts{taskset};
    my $self = $class->SUPER::new(%opts);
    $self->{_taskset} = $ts;
    return $self;
}

sub on_packet {
    my ($self, $packet, $parser) = @_;
    $self->{_taskset}->_process_packet($packet, $parser->source);
}

sub on_error {
    my ($self, $errmsg) = @_;
    die "ERROR: $errmsg\n";
}

1;
