/**
 * This delta includes some queries previously part of delta 041.
 * This changes are moved to a new delta because it depends on delta 050, which
 * was used as fixup to the not-applied delta 024 on existing oasis installations.
 *
 * Seriously, phing.
 */
ALTER TABLE kam_users_xcap MODIFY domain VARCHAR(190) NOT NULL;
ALTER TABLE kam_users_active_watchers MODIFY to_domain VARCHAR(190) NOT NULL;
ALTER TABLE kam_users_active_watchers MODIFY from_domain VARCHAR(190) NOT NULL; 
ALTER TABLE kam_users_watchers MODIFY watcher_domain VARCHAR(190) NOT NULL;
ALTER TABLE kam_users_presentity MODIFY domain VARCHAR(190) NOT NULL;
