/**
 * Evaular si es realmente necesario
 */
ALTER TABLE ast_voicemail MODIFY `password` varchar(80) DEFAULT NULL;
UPDATE ast_voicemail SET `password` = NULL;
