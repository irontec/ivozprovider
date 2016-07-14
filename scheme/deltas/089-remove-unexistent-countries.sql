ALTER TABLE `Timezones` DROP FOREIGN KEY `Timezones_ibfk_2`;
ALTER TABLE `Timezones` ADD CONSTRAINT `Timezones_ibfk_2` FOREIGN KEY (`countryId`) REFERENCES `Countries` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

UPDATE Timezones SET countryId='70' WHERE countryId='62';
UPDATE Timezones SET countryId='70' WHERE countryId='63';

DELETE FROM Countries WHERE code='DO-II';
DELETE FROM Countries WHERE code='DO-III';

