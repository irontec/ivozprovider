# Upgrading Instructions

## Fix Asterisk voicemail paths

Until release 1.7.0, Asterisk voicemail mailboxes were linked to extensions. This meant that *1001@company1* was the voicemail
of the user in company with id '1' whose screen extension was 1001.

This lead to multiple bugs as extensions may change:

- Mailbox was not updated properly when extension changed.
- New user with extension 1001 could listen to previous user messages.
- Orphan mailboxes appeared.

In 1.7.0 a set of changes are made to avoid all this:

- Mailboxes are related to users now: *user1@company1* is the mailbox of the user with id '1' in company with id '1'.

- This is immutable so no triggers are needed anymore.

Database migration in 1.7.0 include a delta that update database accordingly (*ast_ps_endpoints.mailboxes* and *ast_voicemail*),
but filesystem spool folders must be updated too.

For that, a helper script is included:

**After upgrading** your installation run in **any of your data (or standalone)** instances:

```
/opt/irontec/ivozprovider/scripts/UpdateMailboxNames.pl
```

This script does nothing, it only suggests 'mv' commands to have your filesystem updated. Execute these commands at your own risk. 