#!/usr/bin/perl

#TODO: retries?

use strict;
use Gearman::Util;
use Carp ();
use IO::Socket::INET ();

# this is the object that's handed to the worker subrefs
package Gearman::Job;

use fields (
            'func',
            'argref',
            'handle',

            'jss', # job server's socket
            );

sub new {
    my ($class, $func, $argref, $handle, $jss) = @_;
    my $self = $class;
    $self = fields::new($class) unless ref $self;

    $self->{func} = $func;
    $self->{handle} = $handle;
    $self->{argref} = $argref;
    $self->{jss} = $jss;
    return $self;
}

# ->set_status($numerator, $denominator) : $bool_sent_to_jobserver
sub set_status {
    my Gearman::Job $self = shift;
    my ($nu, $de) = @_;

    my $req = Gearman::Util::pack_req_command("work_status",
                                              join("\0", $self->{handle}, $nu, $de));
    die "work_status write failed" unless
        Gearman::Util::send_req($self->{jss}, \$req);
    return 1;
}

sub argref {
    my Gearman::Job $self = shift;
    return $self->{argref};
}

sub arg {
    my Gearman::Job $self = shift;
    return ${ $self->{argref} };
}

sub handle {
    my Gearman::Job $self = shift;
    return $self->{handle};
}

package Gearman::Worker;
use Socket qw(IPPROTO_TCP TCP_NODELAY SOL_SOCKET PF_INET SOCK_STREAM);

use fields (
            'job_servers',
            'js_count',
            'prefix',
            'debug',
            'sock_cache',        # host:port -> IO::Socket::INET
            'last_connect_fail', # host:port -> unixtime
            'down_since',        # host:port -> unixtime
            'connecting',        # host:port -> unixtime connect started at
            'can',               # ability -> subref     (ability is func with optional prefix)
            'timeouts',          # ability -> timeouts
            'client_id',         # random identifer string, no whitespace
            'parent_pipe',       # bool/obj:  if we're a child process of a gearman server,
                                 #   this is socket to our parent process.  also means parent
                                 #   sock can never disconnect or timeout, etc..
            );

BEGIN {
    my $storable = eval { require Storable; 1 }
        if !defined &THROW_EXCEPTIONS || THROW_EXCEPTIONS();

    $storable ||= 0;

    if (defined &THROW_EXCEPTIONS) {
        die "Exceptions support requires Storable: $@";
    } else {
        eval "sub THROW_EXCEPTIONS () { $storable }";
        die "Couldn't define THROW_EXCEPTIONS: $@\n" if $@;
    }
}

sub new {
    my ($class, %opts) = @_;
    my $self = $class;
    $self = fields::new($class) unless ref $self;

    $self->{job_servers} = [];
    $self->{js_count} = 0;
    $self->{sock_cache} = {};
    $self->{last_connect_fail} = {};
    $self->{down_since} = {};
    $self->{can} = {};
    $self->{timeouts} = {};
    $self->{client_id} = join("", map { chr(int(rand(26)) + 97) } (1..30));
    $self->{prefix}   = undef;

    $self->debug($opts{debug}) if $opts{debug};

    if ($ENV{GEARMAN_WORKER_USE_STDIO}) {
        open my $sock, '+<&', \*STDIN or die "Unable to dup STDIN to socket for worker to use.";
        $self->{job_servers} = [ $sock ];
        $self->{parent_pipe} = $sock;

        die "Unable to initialize connection to gearmand"
            unless $self->_on_connect($sock);
    } elsif ($opts{job_servers}) {
        $self->job_servers(@{ $opts{job_servers} });
    }

    $self->prefix($opts{prefix}) if $opts{prefix};

    return $self;
}

sub _get_js_sock {
    my Gearman::Worker $self = shift;
    my $ipport = shift;
    my %opts = @_;

    my $on_connect = delete $opts{on_connect};
    # Someday should warn when called with extra opts.

    warn "getting job server socket: $ipport" if $self->debug;

    # special case, if we're a child process of a gearman::server
    # parent process, talking over a unix pipe...
    return $self->{parent_pipe} if $self->{parent_pipe};

    if (my $sock = $self->{sock_cache}{$ipport}) {
        return $sock if getpeername($sock);
        delete $self->{sock_cache}{$ipport};
    }

    my $now = time;
    my $down_since = $self->{down_since}{$ipport};
    if ($down_since) {
        warn "job server down since $down_since" if $self->debug;

        my $down_for = $now - $down_since;
        my $retry_period = $down_for > 60 ? 30 : (int($down_for / 2) + 1);
        if ($self->{last_connect_fail}{$ipport} > $now - $retry_period) {
            return undef;
        }
    }

    warn "connecting to '$ipport'" if $self->debug;

    my $sock = IO::Socket::INET->new(PeerAddr => $ipport,
                                     Timeout => 1);
    unless ($sock) {
        $self->{down_since}{$ipport} ||= $now;
        $self->{last_connect_fail}{$ipport} = $now;
        return undef;
    }
    delete $self->{last_connect_fail}{$ipport};
    delete $self->{down_since}{$ipport};
    $sock->autoflush(1);
    setsockopt($sock, IPPROTO_TCP, TCP_NODELAY, pack("l", 1)) or die;

    $self->{sock_cache}{$ipport} = $sock;

    unless ($self->_on_connect($sock) && $on_connect && $on_connect->($sock)) {
        delete $self->{sock_cache}{$ipport};
        return undef;
    }

    return $sock;
}

# Housekeeping things to do on connection to a server. Method call
# with one argument being the 'socket' we're going to take care of.
# returns true on success, false on failure.
sub _on_connect {
    my ($self, $sock) = @_;

    my $cid_req = Gearman::Util::pack_req_command("set_client_id", $self->{client_id});
    return undef unless Gearman::Util::send_req($sock, \$cid_req);

    # get this socket's state caught-up
    foreach my $ability (keys %{$self->{can}}) {
        my $timeout = $self->{timeouts}->{$ability};
        unless ($self->_set_ability($sock, $ability, $timeout)) {
            return undef;
        }
    }

    return 1;
}

sub _set_ability {
    my Gearman::Worker $self = shift;
    my ($sock, $ability, $timeout) = @_;

    my $req;
    if (defined $timeout) {
        $req = Gearman::Util::pack_req_command("can_do_timeout", "$ability\0$timeout");
    } else {
        $req = Gearman::Util::pack_req_command("can_do", $ability);
    }
    return Gearman::Util::send_req($sock, \$req);
}

# tell all the jobservers that this worker can't do anything
sub reset_abilities {
    my Gearman::Worker $self = shift;
    my $req = Gearman::Util::pack_req_command("reset_abilities");
    foreach my $js (@{ $self->{job_servers} }) {
        my $jss = $self->_get_js_sock($js)
            or next;

        unless (Gearman::Util::send_req($jss, \$req)) {
            $self->uncache_sock("js", "err_write_reset_abilities");
        }
    }

    $self->{can} = {};
    $self->{timeouts} = {};
}

sub uncache_sock {
    my ($self, $ipport, $reason) = @_;

    # we can't reconnect as a child process, so all we can do is die and hope our
    # parent process respawns us...
    die "Error/timeout talking to gearman parent process: [$reason]" if $self->{parent_pipe};

    # normal case, we just close this TCP connectiona and we'll reconnect later.
    delete $self->{sock_cache}{$ipport};
}

# does one job and returns.  no return value.
sub work {
    my Gearman::Worker $self = shift;
    my %opts = @_;
    my $stop_if = delete $opts{'stop_if'} || sub { 0 };
    my $complete_cb = delete $opts{on_complete};
    my $fail_cb = delete $opts{on_fail};
    my $start_cb = delete $opts{on_start};
    die "Unknown opts" if %opts;

    my $grab_req = Gearman::Util::pack_req_command("grab_job");
    my $presleep_req = Gearman::Util::pack_req_command("pre_sleep");

    my $last_job_time;

    # "Active" job servers are servers that have woken us up and should be
    # queried to see if they have jobs for us to handle. On our first pass
    # in the loop we contact all servers.
    my %active_js = map { $_ => 1 } @{$self->{job_servers}};

    # ( js => last_update_time, ... )
    my %last_update_time;

    while (1) {
        # "Jobby" job servers are the set of server which we will contact
        # on this pass through the loop, because we need to clear and use
        # the "Active" set to plan for our next pass through the loop.
        my @jobby_js = keys %active_js;

        %active_js = ();

        my $js_count = @jobby_js;
        my $js_offset = int(rand($js_count));
        my $is_idle = 0;

        for (my $i = 0; $i < $js_count; $i++) {
            my $js_index = ($i + $js_offset) % $js_count;
            my $js = $jobby_js[$js_index];
            my $jss = $self->_get_js_sock($js)
                or next;

            # TODO: add an optional sleep in here for the test suite
            # to test gearmand server going away here.  (SIGPIPE on
            # send_req, etc) this testing has been done manually, at
            # least.

            unless (Gearman::Util::send_req($jss, \$grab_req)) {
                if ($!{EPIPE} && $self->{parent_pipe}) {
                    # our parent process died, so let's just quit
                    # gracefully.
                    exit(0);
                }
                $self->uncache_sock($js, "grab_job_timeout");
                delete $last_update_time{$js};
                next;
            }

            # if we're a child process talking over a unix pipe, give more
            # time, since we know there are no network issues, and also
            # because on failure, we can't "reconnect".  all we can do is
            # die and hope our parent process respawns us.
            my $timeout = $self->{parent_pipe} ? 5 : 0.50;
            unless (Gearman::Util::wait_for_readability($jss->fileno, $timeout)) {
                $self->uncache_sock($js, "grab_job_timeout");
                delete $last_update_time{$js};
                next;
            }

            my $res;
            do {
                my $err;
                $res = Gearman::Util::read_res_packet($jss, \$err);
                unless ($res) {
                    $self->uncache_sock($js, "read_res_error");
                    delete $last_update_time{$js};
                    next;
                }
            } while ($res->{type} eq "noop");

            if ($res->{type} eq "no_job") {
                unless (Gearman::Util::send_req($jss, \$presleep_req)) {
                    delete $last_update_time{$js};
                    $self->uncache_sock($js, "write_presleep_error");
                }
                $last_update_time{$js} = time;
                next;
            }

            unless ($res->{type} eq "job_assign") {
                my $msg = "Uh, wasn't expecting a $res->{type} packet.";
                if ($res->{type} eq "error") {
                    $msg .= " [${$res->{blobref}}]\n";
                    $msg =~ s/\0/ -- /g;
                }
                die $msg;
            }

            ${ $res->{'blobref'} } =~ s/^(.+?)\0(.+?)\0//
                or die "Uh, regexp on job_assign failed";
            my ($handle, $ability) = ($1, $2);
            my $job = Gearman::Job->new($ability, $res->{'blobref'}, $handle, $jss);

            my $jobhandle = "$js//" . $job->handle;
            $start_cb->($jobhandle) if $start_cb;

            my $handler = $self->{can}{$ability};
            my $ret = eval { $handler->($job); };
            my $err = $@;
            warn "Job '$ability' died: $err" if $err;

            $last_update_time{$js} = $last_job_time = time();

            if (THROW_EXCEPTIONS && $err) {
                my $exception_req = Gearman::Util::pack_req_command("work_exception", join("\0", $handle, Storable::nfreeze(\$err)));
                unless (Gearman::Util::send_req($jss, \$exception_req)) {
                    $self->uncache_sock($js, "write_res_error");
                    next;
                }
            }

            my $work_req;
            if (defined $ret) {
                my $rv = ref $ret ? $$ret : $ret;
                $work_req = Gearman::Util::pack_req_command("work_complete", "$handle\0$rv");
                $complete_cb->($jobhandle, $ret) if $complete_cb;
            } else {
                $work_req = Gearman::Util::pack_req_command("work_fail", $handle);
                $fail_cb->($jobhandle, $err) if $fail_cb;
            }

            unless (Gearman::Util::send_req($jss, \$work_req)) {
                $self->uncache_sock($js, "write_res_error");
                next;
            }

            $active_js{$js} = 1;
        }

        my @jss;

        my $on_connect = sub {
            return Gearman::Util::send_req($_[0], \$presleep_req);
        };

        foreach my $js (@{$self->{job_servers}}) {
            my $jss = $self->_get_js_sock($js, on_connect => $on_connect)
                or next;
            push @jss, [$js, $jss];
        }

        $is_idle = 1;
        my $wake_vec = '';

        foreach my $j (@jss) {
            my ($js, $jss) = @$j;
            my $fd = $jss->fileno;
            vec($wake_vec, $fd, 1) = 1;
        }

        my $timeout = keys %active_js ? 0 : (10 + rand(2));


        # chill for some arbitrary time until we're woken up again
        my $nready = select(my $wout = $wake_vec, undef, undef, $timeout);

        if ($nready) {
            foreach my $j (@jss) {
                my ($js, $jss) = @$j;
                my $fd = $jss->fileno;
                $active_js{$js} = 1
                    if vec($wout, $fd, 1);
            }
        }

        $is_idle = 0 if keys %active_js;

        return if $stop_if->($is_idle, $last_job_time);

        my $update_since = time - (15 + rand 60);

        while (my ($js, $last_update) = each %last_update_time) {
            $active_js{$js} = 1 if $last_update < $update_since;
        }
    }

}

sub register_function {
    my Gearman::Worker $self = shift;
    my $func = shift;
    my $timeout = shift unless (ref $_[0] eq 'CODE');
    my $subref = shift;

    my $prefix = $self->prefix;
    my $ability = defined($prefix) ? "$prefix\t$func" : "$func";

    my $req;
    if (defined $timeout) {
        $req = Gearman::Util::pack_req_command("can_do_timeout", "$ability\0$timeout");
        $self->{timeouts}{$ability} = $timeout;
    } else {
        $req = Gearman::Util::pack_req_command("can_do", $ability);
    }

    $self->_register_all($req);
    $self->{can}{$ability} = $subref;
}

sub unregister_function {
    my Gearman::Worker $self = shift;
    my $func = shift;

    my $prefix = $self->prefix;
    my $ability = defined($prefix) ? "$prefix\t$func" : "$func";

    my $req = Gearman::Util::pack_req_command("cant_do", $ability);

    $self->_register_all($req);
    delete $self->{can}{$ability};
}

sub _register_all {
    my Gearman::Worker $self = shift;
    my $req = shift;

    foreach my $js (@{ $self->{job_servers} }) {
        my $jss = $self->_get_js_sock($js)
            or next;

        unless (Gearman::Util::send_req($jss, \$req)) {
            $self->uncache_sock($js, "write_register_func_error");
        }
    }
}

# getters/setters
sub job_servers {
    my Gearman::Worker $self = shift;
    return if ($ENV{GEARMAN_WORKER_USE_STDIO});
    return $self->{job_servers} unless @_;
    my $list = [ @_ ];
    $self->{js_count} = scalar @$list;
    foreach (@$list) {
        $_ .= ":7003" unless /:/;
    }
    return $self->{job_servers} = $list;
}

sub prefix {
    my Gearman::Worker $self = shift;
    return $self->{prefix} unless @_;
    $self->{prefix} = shift;
}

sub debug {
    my Gearman::Worker $self = shift;
    $self->{debug} = shift if @_;
    return $self->{debug} || 0;
}

1;
__END__

=head1 NAME

Gearman::Worker - Worker for gearman distributed job system

=head1 SYNOPSIS

    use Gearman::Worker;
    my $worker = Gearman::Worker->new;
    $worker->job_servers('127.0.0.1');
    $worker->register_function($funcname => $subref);
    $worker->work while 1;

=head1 DESCRIPTION

I<Gearman::Worker> is a worker class for the Gearman distributed job system,
providing a framework for receiving and serving jobs from a Gearman server.

Callers instantiate a I<Gearman::Worker> object, register a list of functions
and capabilities that they can handle, then enter an event loop, waiting
for the server to send jobs.

The worker can send a return value back to the server, which then gets
sent back to the client that requested the job; or it can simply execute
silently.

=head1 USAGE

=head2 Gearman::Worker->new(%options)

Creates a new I<Gearman::Worker> object, and returns the object.

If I<%options> is provided, initializes the new worker object with the
settings in I<%options>, which can contain:

=over 4

=item * job_servers

Calls I<job_servers> (see below) to initialize the list of job
servers. It will be ignored if this worker is running as a child
process of a gearman server.

=item * prefix

Calls I<prefix> (see below) to set the prefix / namespace.

=back

=head2 $worker->job_servers(@servers)

Initializes the worker I<$worker> with the list of job servers in I<@servers>.
I<@servers> should contain a list of IP addresses, with optional port numbers.
For example:

    $worker->job_servers('127.0.0.1', '192.168.1.100:7003');

If the port number is not provided, 7003 is used as the default.

Calling this method will do nothing in a worker that is running as a child
process of a gearman server.

=head2 $worker->register_function($funcname, $subref)

=head2 $worker->register_function($funcname, $timeout, $subref)

Registers the function I<$funcname> as being provided by the worker
I<$worker>, and advertises these capabilities to all of the job servers
defined in this worker.

I<$subref> must be a subroutine reference that will be invoked when the
worker receives a request for this function. It will be passed a
I<Gearman::Job> object representing the job that has been received by the
worker.

I<$timeout> is an optional parameter specifying how long the jobserver will
wait for your subroutine to give an answer. Exceeding this time will result
in the jobserver reassigning the task and ignoring your result. This prevents
a gimpy worker from ruining the 'user experience' in many situations.

The subroutine reference can return a return value, which will be sent back
to the job server.

=head2 $client-E<gt>prefix($prefix)

Sets the namespace / prefix for the function names.  This is useful
for sharing job servers between different applications or different
instances of the same application (different development sandboxes for
example).

The namespace is currently implemented as a simple tab separated
concatentation of the prefix and the function name.

=head2 Gearman::Job->arg

Returns the scalar argument that the client sent to the job server.

=head2 Gearman::Job->set_status($numerator, $denominator)

Updates the status of the job (most likely, a long-running job) and sends
it back to the job server. I<$numerator> and I<$denominator> should
represent the percentage completion of the job.

=head2 Gearman::Job->work(%opts)

Do one job and returns (no value returned).
You can pass "on_start" "on_complete" and "on_fail" callbacks in I<%opts>.

=head1 WORKERS AS CHILD PROCESSES

Gearman workers can be run run as child processes of a parent process
which embeds L<Gearman::Server>.  When such a parent process
fork/execs a worker, it sets the environment variable
GEARMAN_WORKER_USE_STDIO to true before launching the worker. If this
variable is set to true, then the jobservers function and option for
new() are ignored and the unix socket bound to STDIN/OUT are used
instead as the IO path to the gearman server.

=head1 EXAMPLES

=head2 Summation

This is an example worker that receives a request to sum up a list of
integers.

    use Gearman::Worker;
    use Storable qw( thaw );
    use List::Util qw( sum );
    my $worker = Gearman::Worker->new;
    $worker->job_servers('127.0.0.1');
    $worker->register_function(sum => sub { sum @{ thaw($_[0]->arg) } });
    $worker->work while 1;

See the I<Gearman::Client> documentation for a sample client sending the
I<sum> job.

=cut
