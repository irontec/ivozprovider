ALTER TABLE `Users` DROP KEY `UsersUniqueCompanyUsername`;
ALTER TABLE `Users` ADD UNIQUE KEY `duplicateEmail` (`email`);
ALTER TABLE `Users` ADD UNIQUE KEY `duplicateUserweb` (`username`);
