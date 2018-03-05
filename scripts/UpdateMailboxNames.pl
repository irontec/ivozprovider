#!/usr/bin/perl

# This script does nothing, it only suggests some 'mv' commands for
# renaming filesystem VM paths to adapt to naming convention adapted in 1.7.
#
# It should be executed in standalone/data profiles after upgrading to 1.7
# (this script expects mailboxes in DB with new naming convention)
#
# Logic summary:
#
# Filesystem VM with new name format?
#   a) Yes: Skip.
#   b) No: Linked to voicemail in DB?
#       b1) Yes: Skip
#       b2) No: Does a user have this extension as screen extension
#           b2.1) Yes: print 'mv' command.
#           b2.2) Orphan VM, warn.

use strict;
use File::Basename;
use DBI;
use Term::ANSIColor qw(:constants);

# MySQL connection data
my $db = 'ivozprovider';
my $host = 'data.ivozprovider.local';
my $port = 3306;
my $user = 'asterisk';
my $pass = 'ironsecret';
my $dsn = "DBI:mysql:database=$db;host=$host;port=$port";

# Connect to DB
my $dbh = DBI->connect($dsn, $user, $pass)
    or die "Couldn't connect to database: " . DBI->errstr;

my $BASEPATH = '/opt/irontec/ivozprovider/storage/asterisk/spool/voicemail';

sub exists_in_db {
    my ($companyId, $mailbox) = @_;

    my $query = "SELECT mailbox FROM ast_voicemail WHERE mailbox=? AND context=CONCAT('company', ?)";

    my $sth = $dbh->prepare($query)
          or die "Couldn't prepare statement: $query";
    $sth->bind_param(1, $mailbox);
    $sth->bind_param(2, $companyId);
    $sth->execute()
          or die "Couldn't execute statement: $query";

    my $rows = $sth->rows;
    $sth->finish();

    if ($rows == 0) {
        return 0;
    }

    return 1;
}

sub get_newname {
    my ($companyId, $extension) = @_;

    my $query = "SELECT CONCAT('user', id) AS newname FROM Users WHERE extensionId = (SELECT id FROM Extensions WHERE companyId = ? AND number = ?)";

    my $sth = $dbh->prepare($query)
          or die "Couldn't prepare statement: $query";
    $sth->bind_param(1, $companyId);
    $sth->bind_param(2, $extension);
    $sth->execute()
          or die "Couldn't execute statement: $query";

    my $rows = $sth->rows;

    if ($rows == 1) {
        # Filesystem VM seems an existing extension of company, rename
        my $result = $sth->fetchrow_hashref;
        $sth->finish();
        return $$result{newname};
    } else {
        # Filesystem VM is not an existing extension of company, fix manually
        warn "Orphan FS VM : Extension '$extension' not found in company with companyId '$companyId', fix manually\n";
        $sth->finish();
        return 0;
    }
}

sub rename_mailbox {
    my ($company_path, $mailbox, $newname) = @_;

    my $oldvm = $company_path . '/' . $mailbox;
    my $newvm = $company_path . '/' . $newname;

    print BOLD, GREEN, "mv $oldvm $newvm", RESET, "\n";
}

# Iterate in contexts
for my $company_path (glob "$BASEPATH/*") {
    # Extract companyId from context
    my $companyId;
    my $company = basename $company_path;
    if ($company =~ /company(\d+)/) {
        $companyId = $1;
    } else {
        warn "Error parsing company '$company', fix manually\n";
        next;
    }

    # Iterate in mailboxes within context
    for my $vm_path (glob "$company_path/*") {
        my $mailbox = basename $vm_path;

        # Next if name has new format
        next if $mailbox =~ /^user\d+$|^retail\d+$/;

        # Next if exists in database
        next if &exists_in_db($companyId, $mailbox);

        # Old-name and not linked to database voicemail, try rename
        my $newname = &get_newname($companyId, $mailbox);
        next unless $newname;

        # Rename seems possible, print mv command
        &rename_mailbox($company_path, $mailbox, $newname);
    }
}

# Disconnect from database
$dbh->disconnect;
