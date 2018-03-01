-- Update user mailboxes to new naming
UPDATE ast_voicemail SET mailbox=CONCAT('user', userId) WHERE userId IS NOT NULL;
UPDATE ast_ps_endpoints ape JOIN Terminals T ON ape.terminalId=T.id JOIN Users U ON U.terminalId=T.id SET ape.mailboxes=CONCAT('user', U.id, '@company', U.companyId);

-- Clean ast_ps_endpoints.mailboxes that don't exist
UPDATE ast_ps_endpoints SET mailboxes=NULL WHERE mailboxes NOT IN (SELECT CONCAT(mailbox, '@', context) FROM ast_voicemail);
