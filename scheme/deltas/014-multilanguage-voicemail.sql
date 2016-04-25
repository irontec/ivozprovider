ALTER TABLE Companies
  ADD COLUMN `languageId` int(10) unsigned DEFAULT NULL,
  ADD FOREIGN KEY `languageId` (`languageId`) REFERENCES Languages(`id`) ON DELETE SET NULL;


ALTER TABLE Users
  ADD COLUMN `languageId` int(10) unsigned DEFAULT NULL,
  ADD FOREIGN KEY `languageId` (`languageId`) REFERENCES Languages(`id`) ON DELETE SET NULL;

ALTER TABLE Brands
  ADD COLUMN `languageId` int(10) unsigned DEFAULT NULL,
  ADD FOREIGN KEY `languageId` (`languageId`) REFERENCES Languages(`id`) ON DELETE SET NULL;


DROP TABLE BrandsRelLanguages;

ALTER TABLE Companies DROP FOREIGN KEY `Companies_ibfk_8`;
ALTER TABLE Companies DROP `invoiceLanguageId`;
