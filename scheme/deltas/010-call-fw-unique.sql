ALTER TABLE `CallForwardSettings` DROP KEY `callFwTypeUser`;
ALTER TABLE `CallForwardSettings` ADD UNIQUE KEY `callFwTypeUser` (`callForwardType`,`userId`, `callTypeFilter`);
