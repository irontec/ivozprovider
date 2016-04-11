use strict;

package Gearman::Objects;
# this dummy package exists purely for building RPMs,
# some tools of which have requirements for above package
# line and the filename to match somehow.

package Gearman::Client;
use fields (
            'job_servers',
            'js_count',
            'sock_cache',  # hostport -> socket
            'sock_info',   # hostport -> hashref
            'hooks',       # hookname -> coderef
            'prefix',
            'debug',
            'exceptions',
            'backoff_max',
            'command_timeout', # maximum time a gearman command should take to get a result (not a job timeout)
            );

package Gearman::Taskset;

use fields (
            'waiting',  # { handle => [Task, ...] }
            'client',   # Gearman::Client
            'need_handle',  # arrayref

            'default_sock',     # default socket (non-merged requests)
            'default_sockaddr', # default socket's ip/port

            'loaned_sock',      # { hostport => socket }
            'cancelled',        # bool, if taskset has been cancelled mid-processing
            'hooks',       # hookname -> coderef
            );


package Gearman::Task;

use fields (
            # from client:
            'func',
            'argref',
            # opts from client:
            'uniq',
            'on_complete',
            'on_fail',
            'on_exception',
            'on_retry',
            'on_status',
            'on_post_hooks',   # used internally, when other hooks are done running, prior to cleanup
            'retry_count',
            'timeout',
            'try_timeout',
            'high_priority',
            'background',

            # from server:
            'handle',

            # maintained by this module:
            'retries_done',
            'is_finished',
            'taskset',
            'jssock',  # jobserver socket.  shared by other tasks in the same taskset,
                       # but not w/ tasks in other tasksets using the same Gearman::Client
            'hooks',       # hookname -> coderef
            );


1;
