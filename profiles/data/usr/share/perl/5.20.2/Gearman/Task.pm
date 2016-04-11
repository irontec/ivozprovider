package Gearman::Task;

use strict;
use Carp ();
use String::CRC32 ();

use Gearman::Taskset;
use Gearman::Util;

BEGIN {
    my $storable = eval { require Storable; 1 }
    if !defined &RECEIVE_EXCEPTIONS || RECEIVE_EXCEPTIONS();

    $storable ||= 0;

    if (defined &RECEIVE_EXCEPTIONS) {
        die "Exceptions support requires Storable: $@";
    } else {
        eval "sub RECEIVE_EXCEPTIONS () { $storable }";
        die "Couldn't define RECEIVE_EXCEPTIONS: $@\n" if $@;
    }
}

# constructor, given: ($func, $argref, $opts);
sub new {
    my $class = shift;

    my $self = $class;
    $self = fields::new($class) unless ref $self;

    $self->{func} = shift
        or Carp::croak("No function given");

    $self->{argref} = shift || do { my $empty = ""; \$empty; };
    Carp::croak("Argref not a scalar reference") unless ref $self->{argref} eq "SCALAR";

    my $opts = shift || {};
    for my $k (qw( uniq
                   on_complete on_exception on_fail on_retry on_status
                   retry_count timeout high_priority background try_timeout
               )) {
        $self->{$k} = delete $opts->{$k};
    }

    $self->{retry_count} ||= 0;

    $self->{is_finished} = 0;  # bool: if success or fail has been called yet on this.

    if (%{$opts}) {
        Carp::croak("Unknown option(s): " . join(", ", sort keys %$opts));
    }

    $self->{retries_done} = 0;

    return $self;
}

sub run_hook {
    my Gearman::Task $self = shift;
    my $hookname = shift || return;

    my $hook = $self->{hooks}->{$hookname};
    return unless $hook;

    eval { $hook->(@_) };

    warn "Gearman::Task hook '$hookname' threw error: $@\n" if $@;
}

sub add_hook {
    my Gearman::Task $self = shift;
    my $hookname = shift || return;

    if (@_) {
        $self->{hooks}->{$hookname} = shift;
    } else {
        delete $self->{hooks}->{$hookname};
    }
}

sub is_finished {
    my Gearman::Task $task = $_[0];
    return $task->{is_finished};
}

sub taskset {
    my Gearman::Task $task = shift;

    # getter
    return $task->{taskset} unless @_;

    # setter
    my Gearman::Taskset $ts = shift;
    $task->{taskset} = $ts;

    my $merge_on = $task->{uniq} && $task->{uniq} eq "-" ?
        $task->{argref} : \ $task->{uniq};
    if ($$merge_on) {
        my $hash_num = _hashfunc($merge_on);
        $task->{jssock} = $ts->_get_hashed_sock($hash_num);
    } else {
        $task->{jssock} = $ts->_get_default_sock;
    }

    return $task->{taskset};
}

# returns undef on non-uniq packet, or the hash value (0-32767) if uniq
sub hash {
    my Gearman::Task $task = shift;

    my $merge_on = $task->{uniq} && $task->{uniq} eq "-" ?
        $task->{argref} : \ $task->{uniq};
    if ($$merge_on) {
        return _hashfunc( $merge_on );
    } else {
        return undef;
    }
}

# returns number in range [0,32767] given a scalarref
sub _hashfunc {
    return (String::CRC32::crc32(${ shift() }) >> 16) & 0x7fff;
}

sub pack_submit_packet {
    my Gearman::Task $task = shift;
    my Gearman::Client $client = shift;

    my $mode = $task->{background} ?
        "submit_job_bg" :
        ($task->{high_priority} ?
         "submit_job_high" :
         "submit_job");

    my $func = $task->{func};

    if (my $prefix = $client && $client->prefix) {
        $func = join "\t", $prefix, $task->{func};
    }

    return Gearman::Util::pack_req_command($mode,
                                           join("\0",
                                                $func || '',
                                                $task->{uniq} || '',
                                                ${ $task->{argref} } || ''));
}

sub fail {
    my Gearman::Task $task = shift;
    my $reason = shift;
    return if $task->{is_finished};

    # try to retry, if we can
    if ($task->{retries_done} < $task->{retry_count}) {
        $task->{retries_done}++;
        $task->{on_retry}->($task->{retries_done}) if $task->{on_retry};
        $task->handle(undef);
        return $task->{taskset}->add_task($task);
    }

    $task->final_fail($reason);
}

sub final_fail {
    my Gearman::Task $task = $_[0];
    my $reason = $_[1];

    return if $task->{is_finished};
    $task->{is_finished} = $_[1] || 1;

    $task->run_hook('final_fail', $task);

    $task->{on_fail}->($reason) if $task->{on_fail};
    $task->{on_post_hooks}->()  if $task->{on_post_hooks};
    $task->wipe;

    return undef;
}

sub exception {
    my Gearman::Task $task = shift;

    return unless RECEIVE_EXCEPTIONS;

    my $exception_ref = shift;
    my $exception = Storable::thaw($$exception_ref);
    $task->{on_exception}->($$exception) if $task->{on_exception};
    return;
}

sub complete {
    my Gearman::Task $task = shift;
    return if $task->{is_finished};

    my $result_ref = shift;
    $task->{is_finished} = 'complete';

    $task->run_hook('complete', $task);

    $task->{on_complete}->($result_ref) if $task->{on_complete};
    $task->{on_post_hooks}->()          if $task->{on_post_hooks};
    $task->wipe;
}

sub status {
    my Gearman::Task $task = shift;
    return if $task->{is_finished};
    return unless $task->{on_status};
    my ($nu, $de) = @_;
    $task->{on_status}->($nu, $de);
}

# getter/setter for the fully-qualified handle of form "IP:port//shandle" where
# shandle is an opaque handle specific to the job server running on IP:port
sub handle {
    my Gearman::Task $task = shift;
    return $task->{handle} unless @_;
    return $task->{handle} = shift;
}

sub set_on_post_hooks {
    my Gearman::Task $task = shift;
    my $code = shift;
    $task->{on_post_hooks} = $code;
}


sub wipe {
    my Gearman::Task $task = shift;
    foreach my $f (qw(on_post_hooks on_complete on_fail on_retry on_status hooks)) {
        $task->{$f} = undef;
    }
}

sub func {
    my Gearman::Task $task = shift;
    return $task->{func};
}

sub timeout {
    my Gearman::Task $task = shift;
    return $task->{timeout} unless @_;
    return $task->{timeout} = shift;
}
1;
__END__

=head1 NAME

Gearman::Task - a task in Gearman, from the point of view of a client

=head1 SYNOPSIS

    my $task = Gearman::Task->new("add", "1+2", {
            .....

    };

    $taskset->add_task($task);
    $client->do_task($task);
    $client->dispatch_background($task);


=head1 DESCRIPTION

I<Gearman::Task> is a Gearman::Client's representation of a task to be
done.

=head1 USAGE

=head2 Gearman::Task->new($func, $arg, \%options)

Creates a new I<Gearman::Task> object, and returns the object.

I<$func> is the function name to be run.  (that you have a worker registered to process)

I<$arg> is an opaque scalar or scalarref representing the argument(s)
to pass to the distributed function.  If you want to pass multiple
arguments, you must encode them somehow into this one.  That's up to
you and your worker.

I<%options> can contain:

=over 4

=item * uniq

A key which indicates to the server that other tasks with the same
function name and key will be merged into one.  That is, the task
will be run just once, but all the listeners waiting on that job
will get the response multiplexed back to them.

Uniq may also contain the magic value "-" (a single hyphen) which
means the uniq key is the contents of the args.

=item * on_complete

A subroutine reference to be invoked when the task is completed. The
subroutine will be passed a reference to the return value from the worker
process.

=item * on_fail

A subroutine reference to be invoked when the task fails (or fails for
the last time, if retries were specified).  No arguments are
passed to this callback.  This callback won't be called after a failure
if more retries are still possible.

=item * on_retry

A subroutine reference to be invoked when the task fails, but is about
to be retried.

Is passed one argument, what retry attempt number this is.  (starts with 1)

=item * on_status

A subroutine reference to be invoked if the task emits status updates.
Arguments passed to the subref are ($numerator, $denominator), where those
are left up to the client and job to determine.

=item * retry_count

Number of times job will be retried if there are failures.  Defaults to 0.

=item * high_priority

Boolean, whether this job should take priority over other jobs already
enqueued.

=item * timeout

Automatically fail, calling your on_fail callback, after this many
seconds have elapsed without an on_fail or on_complete being
called. Defaults to 0, which means never.  Bypasses any retry_count
remaining.

=item * try_timeout

Automatically fail, calling your on_retry callback (or on_fail if out of
retries), after this many seconds have elapsed. Defaults to 0, which means
never.

=back

=head2 $task->is_finished

Returns bool: whether or not task is totally done (on_failure or
on_complete callback has been called)

=cut
