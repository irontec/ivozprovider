<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171024113642 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        // Create RuleSets table and relations
        $this->addSql('CREATE TABLE TransformationRuleSets (id INT UNSIGNED AUTO_INCREMENT NOT NULL, name_en VARCHAR(100) NOT NULL, name_es VARCHAR(100) NOT NULL, description VARCHAR(250) DEFAULT NULL, internationalCode VARCHAR(10) DEFAULT \'00\', trunkPrefix VARCHAR(5) DEFAULT \'\', areaCode VARCHAR(5) DEFAULT \'\', nationalLen INT UNSIGNED DEFAULT 9, brandId INT UNSIGNED DEFAULT NULL, countryId INT UNSIGNED DEFAULT NULL, generateRules TINYINT(1) DEFAULT "0", INDEX IDX_C272BD0FFBA2A6B4 (countryId), INDEX brandId (brandId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 ENGINE = InnoDB');
        $this->addSql('ALTER TABLE TransformationRuleSets ADD CONSTRAINT FK_C272BD0F9CBEC244 FOREIGN KEY (brandId) REFERENCES Brands (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE TransformationRuleSets ADD CONSTRAINT FK_C272BD0FFBA2A6B4 FOREIGN KEY (countryId) REFERENCES Countries (id) ON DELETE CASCADE');
        $this->addSql('CREATE TABLE TransformationRules (id INT UNSIGNED AUTO_INCREMENT NOT NULL, type VARCHAR(10) NOT NULL COMMENT \'[enum:callerin|calleein|callerout|calleeout]\', description VARCHAR(64) DEFAULT \'\' NOT NULL, priority INT UNSIGNED DEFAULT NULL, matchExpr VARCHAR(128) DEFAULT NULL, replaceExpr VARCHAR(128) DEFAULT NULL, transformationRuleSetId INT UNSIGNED DEFAULT NULL, INDEX transformationRuleSet (transformationRuleSetId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 ENGINE = InnoDB');
        $this->addSql('ALTER TABLE TransformationRules ADD CONSTRAINT FK_C82DE1742FECF701 FOREIGN KEY (transformationRuleSetId) REFERENCES TransformationRuleSets (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE Companies ADD transformationRuleSetId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE Companies ADD CONSTRAINT FK_B528992FECF701 FOREIGN KEY (transformationRuleSetId) REFERENCES TransformationRuleSets (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_B528992FECF701 ON Companies (transformationRuleSetId)');
        $this->addSql('ALTER TABLE Users ADD transformationRuleSetId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE Users ADD CONSTRAINT FK_D5428AED2FECF701 FOREIGN KEY (transformationRuleSetId) REFERENCES TransformationRuleSets (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_D5428AED2FECF701 ON Users (transformationRuleSetId)');
        $this->addSql('ALTER TABLE Friends ADD transformationRuleSetId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE Friends ADD CONSTRAINT FK_EE5349F52FECF701 FOREIGN KEY (transformationRuleSetId) REFERENCES TransformationRuleSets (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_EE5349F52FECF701 ON Friends (transformationRuleSetId)');
        $this->addSql('ALTER TABLE RetailAccounts ADD transformationRuleSetId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE RetailAccounts ADD CONSTRAINT FK_732D92502FECF701 FOREIGN KEY (transformationRuleSetId) REFERENCES TransformationRuleSets (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_732D92502FECF701 ON RetailAccounts (transformationRuleSetId)');
        $this->addSql('ALTER TABLE PeeringContracts ADD transformationRuleSetId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE PeeringContracts ADD CONSTRAINT FK_6E479B022FECF701 FOREIGN KEY (transformationRuleSetId) REFERENCES TransformationRuleSets (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_6E479B022FECF701 ON PeeringContracts (transformationRuleSetId)');

        // Preload RuleSet from Countries
        $this->addSql('INSERT INTO TransformationRuleSets (id, brandId, name_en, name_es, description, internationalCode, countryId) SELECT id, NULL, name_en, name_es, CONCAT("Generic transformation for ", name_en), intCode, id FROM Countries');

        // Preload RuleSet from Companies
        $this->addSql('UPDATE Companies SET areaCode = "" WHERE areaCode IS NULL');
        $this->addSql('UPDATE Companies SET areaCode = "" WHERE areaCode NOT REGEXP \'[[:digit:]]+\'');
        $this->addSql('UPDATE Companies SET transformationRuleSetId = (SELECT id FROM TransformationRuleSets WHERE countryId = Companies.countryId AND areaCode = Companies.areaCode)');
        $this->addSql('INSERT INTO TransformationRuleSets (brandId, name_en, name_es, description, areaCode, countryId) SELECT brandId, CONCAT(name_es, " (Area ", areaCode, ")"), CONCAT(name_en, " (Area ", areaCode, ")"), "Imported from Companies", areaCode, countryId FROM Companies INNER JOIN Countries ON Countries.id = Companies.countryId WHERE transformationRuleSetId IS NULL GROUP BY brandId, countryId, areaCode');
        $this->addSql('UPDATE Companies SET transformationRuleSetId = (SELECT id FROM TransformationRuleSets WHERE countryId = Companies.countryId AND areaCode = Companies.areaCode)');

        // Preload RuleSet from Users
        $this->addSql('UPDATE Users SET areaCode = (SELECT areaCode FROM Companies WHERE id = Users.companyId AND countryId = Users.countryId) WHERE Users.areaCode IS NULL OR Users.areaCode = ""');
        $this->addSql('UPDATE Users SET areaCode = "" WHERE areaCode IS NULL');
        $this->addSql('UPDATE Users SET areaCode = "" WHERE areaCode NOT REGEXP \'[[:digit:]]+\'');
        $this->addSql('UPDATE Users SET countryId = (SELECT countryId FROM Companies WHERE id = Users.companyId) WHERE countryId IS NULL');
        $this->addSql('UPDATE Users SET transformationRuleSetId = (SELECT id FROM TransformationRuleSets WHERE countryId = Users.countryId AND areaCode = Users.areaCode)');
        $this->addSql('INSERT INTO TransformationRuleSets (brandId, name_en, name_es, description, areaCode, countryId) SELECT Companies.brandId, CONCAT(Countries.name_es, " (Area ", Users.areaCode, ")"), CONCAT(name_en, " (Area ", Users.areaCode, ")"), "Imported from Users", Users.areaCode, Users.countryId FROM Users INNER JOIN Companies ON Companies.id =  Users.companyId INNER JOIN Countries ON Countries.id = Users.countryId WHERE Users.transformationRuleSetId IS NULL GROUP BY Companies.brandId, Users.countryId, Users.areaCode');
        $this->addSql('UPDATE Users SET transformationRuleSetId = (SELECT id FROM TransformationRuleSets WHERE countryId = Users.countryId AND areaCode = Users.areaCode)');

        // Preload RuleSet from Friends
        $this->addSql('UPDATE Friends SET areaCode = (SELECT areaCode FROM Companies WHERE id = Friends.companyId AND countryId = Friends.countryId) WHERE Friends.areaCode IS NULL OR Friends.areaCode = ""');
        $this->addSql('UPDATE Friends SET areaCode = "" WHERE areaCode IS NULL');
        $this->addSql('UPDATE Friends SET areaCode = "" WHERE areaCode NOT REGEXP \'[[:digit:]]+\'');
        $this->addSql('UPDATE Friends SET countryId = (SELECT countryId FROM Companies WHERE id = Friends.companyId) WHERE countryId IS NULL');
        $this->addSql('UPDATE Friends SET transformationRuleSetId = (SELECT id FROM TransformationRuleSets WHERE countryId = Friends.countryId AND areaCode = Friends.areaCode)');
        $this->addSql('INSERT INTO TransformationRuleSets (brandId, name_en, name_es, description, areaCode, countryId) SELECT Companies.brandId, CONCAT(Countries.name_es, " (Area ", Friends.areaCode, ")"), CONCAT(name_en, " (Area ", Friends.areaCode, ")"), "Imported from Friends", Friends.areaCode, Friends.countryId FROM Friends INNER JOIN Companies ON Companies.id =  Friends.companyId INNER JOIN Countries ON Countries.id = Friends.countryId WHERE Friends.transformationRuleSetId IS NULL GROUP BY Companies.brandId, Friends.countryId, Friends.areaCode');
        $this->addSql('UPDATE Friends SET transformationRuleSetId = (SELECT id FROM TransformationRuleSets WHERE countryId = Friends.countryId AND areaCode = Friends.areaCode)');

        // Preload RuleSet from RetailAccounts
        $this->addSql('UPDATE RetailAccounts SET areaCode = (SELECT areaCode FROM Companies WHERE id = RetailAccounts.companyId AND countryId = RetailAccounts.countryId) WHERE RetailAccounts.areaCode IS NULL OR RetailAccounts.areaCode = ""');
        $this->addSql('UPDATE RetailAccounts SET areaCode = "" WHERE areaCode IS NULL');
        $this->addSql('UPDATE RetailAccounts SET areaCode = "" WHERE areaCode NOT REGEXP \'[[:digit:]]+\'');
        $this->addSql('UPDATE RetailAccounts SET countryId = (SELECT countryId FROM Companies WHERE id = RetailAccounts.companyId) WHERE countryId IS NULL');
        $this->addSql('UPDATE RetailAccounts SET transformationRuleSetId = (SELECT id FROM TransformationRuleSets WHERE countryId = RetailAccounts.countryId AND areaCode = RetailAccounts.areaCode)');
        $this->addSql('INSERT INTO TransformationRuleSets (brandId, name_en, name_es, description, areaCode, countryId) SELECT Companies.brandId, CONCAT(Countries.name_es, " (Area ", RetailAccounts.areaCode, ")"), CONCAT(name_en, " (Area ", RetailAccounts.areaCode, ")"), "Imported from RetailAccounts", RetailAccounts.areaCode, RetailAccounts.countryId FROM RetailAccounts INNER JOIN Companies ON Companies.id =  RetailAccounts.companyId INNER JOIN Countries ON Countries.id = RetailAccounts.countryId WHERE RetailAccounts.transformationRuleSetId IS NULL GROUP BY Companies.brandId, RetailAccounts.countryId, RetailAccounts.areaCode');
        $this->addSql('UPDATE RetailAccounts SET transformationRuleSetId = (SELECT id FROM TransformationRuleSets WHERE countryId = RetailAccounts.countryId AND areaCode = RetailAccounts.areaCode)');

        // Fix Imported countries data
        $this->addSql('UPDATE TransformationRuleSets SET trunkPrefix="0" WHERE countryId IN (SELECT id FROM Countries WHERE code in ("FR", "GR", "EG", "MA", "KE", "ZA", "TZ", "RW", "NG", "AR", "BO", "BR", "PE", "VE", "AF", "BD", "MM", "KH", "CN", "IN", "ID", "IR", "IL", "JP", "JO", "KP", "KR", "LA", "MY", "MN", "PK", "PH", "TW", "TH", "VN", "AE", "SA", "AL", "AT", "BE", "BA", "BG", "HR", "CY", "FI", "IE", "MK", "MD", "ME", "NL", "RO", "RS", "SK", "SI", "SE", "CH", "TR", "UA", "GB", "AU", "NZ", "CU"))');
        $this->addSql('UPDATE TransformationRuleSets SET trunkPrefix="01" WHERE countryId IN (SELECT id FROM Countries WHERE code in ("MX"))');
        $this->addSql('UPDATE TransformationRuleSets SET trunkPrefix="06" WHERE countryId IN (SELECT id FROM Countries WHERE code in ("HU"))');
        $this->addSql('UPDATE TransformationRuleSets SET trunkPrefix="8" WHERE countryId IN (SELECT id FROM Countries WHERE code in ("AZ", "KZ", "RU", "TM", "UZ", "BY", "LT"))');
        $this->addSql('UPDATE TransformationRuleSets SET trunkPrefix="1" WHERE countryId IN (SELECT id FROM Countries WHERE code in ("US", "CA", "AS", "AI", "AG", "BS", "BB", "BM", "VG", "KY", "DM", "DO", "GD", "GU", "JM", "MS", "MP", "PR", "KN", "LC", "VC", "SX", "TT", "TC", "VI"))');
        $this->addSql('UPDATE TransformationRuleSets SET nationalLen=7 WHERE id IN (SELECT id FROM Countries WHERE code in ("AD", "CU"))');
        $this->addSql('UPDATE TransformationRuleSets SET internationalCode=119 WHERE id IN (SELECT id FROM Countries WHERE code in ("CU"))');

        // Add E.164 transformations
        $this->addSql('INSERT INTO TransformationRuleSets (name_en, name_es, description) VALUES ("E.164", "E.164", "No numeric transformation")');

        // Remove deprecated fields in Countries table
        $this->addSql('ALTER TABLE Countries DROP intCode, DROP e164Pattern, DROP nationalCC, CHANGE calling_code countryCode VARCHAR(10) DEFAULT NULL');
		$this->addSql('UPDATE Countries SET countryCode = CONCAT("\+", countryCode)');

        // Generate Rules for existing Rulesets
        $this->addSql('INSERT INTO TransformationRules (transformationRuleSetId, type, description, priority, matchExpr, replaceExpr) SELECT TransformationRuleSets.id, "callerout", "From e164 to within area national", 1, CONCAT("^\\\\", countryCode, areaCode, "([0-9]{", nationalLen - LENGTH(areaCode), "})$"), "\\\\1" FROM TransformationRuleSets INNER JOIN Countries ON Countries.id = TransformationRuleSets.countryId WHERE areaCode != ""');
        $this->addSql('INSERT INTO TransformationRules (transformationRuleSetId, type, description, priority, matchExpr, replaceExpr) SELECT TransformationRuleSets.id, "callerout", "From e164 to out of area national", 2, CONCAT("^\\\\", countryCode, "([0-9]{", nationalLen, "})$"), CONCAT(trunkPrefix, "\\\\1") FROM TransformationRuleSets INNER JOIN Countries ON Countries.id = TransformationRuleSets.countryId WHERE trunkPrefix != ""');
        $this->addSql('INSERT INTO TransformationRules (transformationRuleSetId, type, description, priority, matchExpr, replaceExpr) SELECT TransformationRuleSets.id, "callerout", "From e164 to special national", 3, CONCAT("^\\\\", countryCode, "([0-9]+)$"), "\\\\1" FROM TransformationRuleSets INNER JOIN Countries ON Countries.id = TransformationRuleSets.countryId ');
        $this->addSql('INSERT INTO TransformationRules (transformationRuleSetId, type, description, priority, matchExpr, replaceExpr) SELECT TransformationRuleSets.id, "callerout", "From e164 to international", 4, "^\\\\+([0-9]+)$", CONCAT(internationalCode, "\\\\1") FROM TransformationRuleSets INNER JOIN Countries ON Countries.id = TransformationRuleSets.countryId ');
        $this->addSql('INSERT INTO TransformationRules (transformationRuleSetId, type, description, priority, matchExpr, replaceExpr) SELECT TransformationRuleSets.id, "calleeout", "From e164 to within area national", 1, CONCAT("^\\\\", countryCode, areaCode, "([0-9]{", nationalLen - LENGTH(areaCode), "})$"), "\\\\1" FROM TransformationRuleSets INNER JOIN Countries ON Countries.id = TransformationRuleSets.countryId WHERE areaCode != ""');
        $this->addSql('INSERT INTO TransformationRules (transformationRuleSetId, type, description, priority, matchExpr, replaceExpr) SELECT TransformationRuleSets.id, "calleeout", "From e164 to out of area national", 2, CONCAT("^\\\\", countryCode, "([0-9]{", nationalLen, "})$"), CONCAT(trunkPrefix, "\\\\1") FROM TransformationRuleSets INNER JOIN Countries ON Countries.id = TransformationRuleSets.countryId WHERE trunkPrefix != ""');
        $this->addSql('INSERT INTO TransformationRules (transformationRuleSetId, type, description, priority, matchExpr, replaceExpr) SELECT TransformationRuleSets.id, "calleeout", "From e164 to special national", 3, CONCAT("^\\\\", countryCode, "([0-9]+)$"), "\\\\1" FROM TransformationRuleSets INNER JOIN Countries ON Countries.id = TransformationRuleSets.countryId ');
        $this->addSql('INSERT INTO TransformationRules (transformationRuleSetId, type, description, priority, matchExpr, replaceExpr) SELECT TransformationRuleSets.id, "calleeout", "From e164 to international", 4, "^\\\\+([0-9]+)$", CONCAT(internationalCode, "\\\\1") FROM TransformationRuleSets INNER JOIN Countries ON Countries.id = TransformationRuleSets.countryId ');
        $this->addSql('INSERT INTO TransformationRules (transformationRuleSetId, type, description, priority, matchExpr, replaceExpr) SELECT TransformationRuleSets.id, "callerin", "From international to e164", 1,  CONCAT("^(\\\\+|", internationalCode, ")([0-9]+)$"), "+\\\\2" FROM TransformationRuleSets INNER JOIN Countries ON Countries.id = TransformationRuleSets.countryId ');
        $this->addSql('INSERT INTO TransformationRules (transformationRuleSetId, type, description, priority, matchExpr, replaceExpr) SELECT TransformationRuleSets.id, "callerin", "From out of area national to e164", 2,  CONCAT("^", trunkPrefix, "([0-9]{",nationalLen,"})$"), CONCAT(countryCode, "\\\\1") FROM TransformationRuleSets INNER JOIN Countries ON Countries.id = TransformationRuleSets.countryId WHERE trunkPrefix != ""');
        $this->addSql('INSERT INTO TransformationRules (transformationRuleSetId, type, description, priority, matchExpr, replaceExpr) SELECT TransformationRuleSets.id, "callerin", "From within national to e164", 3,  CONCAT("^([0-9]{",nationalLen - LENGTH(areaCode),"})$"), CONCAT(countryCode, areaCode, "\\\\1") FROM TransformationRuleSets INNER JOIN Countries ON Countries.id = TransformationRuleSets.countryId WHERE areaCode != ""');
        $this->addSql('INSERT INTO TransformationRules (transformationRuleSetId, type, description, priority, matchExpr, replaceExpr) SELECT TransformationRuleSets.id, "callerin", "From special national to e164", 4,  "^([0-9]+)$", CONCAT(countryCode, "\\\\1") FROM TransformationRuleSets INNER JOIN Countries ON Countries.id = TransformationRuleSets.countryId ');
        $this->addSql('INSERT INTO TransformationRules (transformationRuleSetId, type, description, priority, matchExpr, replaceExpr) SELECT TransformationRuleSets.id, "calleein", "From international to e164", 1,  CONCAT("^(\\\\+|", internationalCode, ")([0-9]+)$"), "+\\\\2" FROM TransformationRuleSets INNER JOIN Countries ON Countries.id = TransformationRuleSets.countryId ');
        $this->addSql('INSERT INTO TransformationRules (transformationRuleSetId, type, description, priority, matchExpr, replaceExpr) SELECT TransformationRuleSets.id, "calleein", "From out of area national to e164", 2,  CONCAT("^", trunkPrefix, "([0-9]{",nationalLen,"})$"), CONCAT(countryCode, "\\\\1") FROM TransformationRuleSets INNER JOIN Countries ON Countries.id = TransformationRuleSets.countryId WHERE trunkPrefix != ""');
        $this->addSql('INSERT INTO TransformationRules (transformationRuleSetId, type, description, priority, matchExpr, replaceExpr) SELECT TransformationRuleSets.id, "calleein", "From within national to e164", 3,  CONCAT("^([0-9]{",nationalLen - LENGTH(areaCode),"})$"), CONCAT(countryCode, areaCode, "\\\\1") FROM TransformationRuleSets INNER JOIN Countries ON Countries.id = TransformationRuleSets.countryId WHERE areaCode != ""');
        $this->addSql('INSERT INTO TransformationRules (transformationRuleSetId, type, description, priority, matchExpr, replaceExpr) SELECT TransformationRuleSets.id, "calleein", "From special national to e164", 4,  "^([0-9]+)$", CONCAT(countryCode, "\\\\1") FROM TransformationRuleSets INNER JOIN Countries ON Countries.id = TransformationRuleSets.countryId ');

        // Import old Transformations
        $this->addSql('ALTER TABLE TransformationRuleSets ADD transformationOldId INT UNSIGNED DEFAULT NULL');
        $this->addSql('INSERT INTO TransformationRuleSets (brandId, name_en, name_es, description, countryId, internationalCode, nationalLen, transformationOldId) SELECT brandId, CONCAT("PeerTransformation ", name), CONCAT("PeerTransformation ", name), description, countryId, internationalCode, nationalNumLength, id FROM TransformationRulesetGroupsTrunks');
        $this->addSql('INSERT INTO TransformationRules (`type`, description, priority, matchExpr, replaceExpr, transformationRuleSetId) SELECT "callerin", attrs, pr, match_exp, repl_exp, TRS.id FROM kam_trunks_dialplan K INNER JOIN TransformationRulesetGroupsTrunks TRGT ON TRGT.id = K.transformationRulesetGroupsTrunksId  INNER JOIN TransformationRuleSets TRS ON TRS.transformationOldId = TRGT.id WHERE K.dpid IN (SELECT caller_in FROM TransformationRulesetGroupsTrunks)');
        $this->addSql('INSERT INTO TransformationRules (`type`, description, priority, matchExpr, replaceExpr, transformationRuleSetId) SELECT "calleein", attrs, pr, match_exp, repl_exp, TRS.id FROM kam_trunks_dialplan K INNER JOIN TransformationRulesetGroupsTrunks TRGT ON TRGT.id = K.transformationRulesetGroupsTrunksId  INNER JOIN TransformationRuleSets TRS ON TRS.transformationOldId = TRGT.id WHERE K.dpid IN (SELECT callee_in FROM TransformationRulesetGroupsTrunks)');
        $this->addSql('INSERT INTO TransformationRules (`type`, description, priority, matchExpr, replaceExpr, transformationRuleSetId) SELECT "callerout", attrs, pr, match_exp, repl_exp, TRS.id FROM kam_trunks_dialplan K INNER JOIN TransformationRulesetGroupsTrunks TRGT ON TRGT.id = K.transformationRulesetGroupsTrunksId  INNER JOIN TransformationRuleSets TRS ON TRS.transformationOldId = TRGT.id WHERE K.dpid IN (SELECT caller_out FROM TransformationRulesetGroupsTrunks)');
        $this->addSql('INSERT INTO TransformationRules (`type`, description, priority, matchExpr, replaceExpr, transformationRuleSetId) SELECT "calleeout", attrs, pr, match_exp, repl_exp, TRS.id FROM kam_trunks_dialplan K INNER JOIN TransformationRulesetGroupsTrunks TRGT ON TRGT.id = K.transformationRulesetGroupsTrunksId  INNER JOIN TransformationRuleSets TRS ON TRS.transformationOldId = TRGT.id WHERE K.dpid IN (SELECT callee_out FROM TransformationRulesetGroupsTrunks)');
        $this->addSql('UPDATE PeeringContracts SET transformationRuleSetId = (SELECT id from TransformationRuleSets WHERE transformationOldId = transformationRulesetGroupsTrunksId)');
        $this->addSql('ALTER TABLE TransformationRuleSets DROP transformationOldId');

		// Fix existing Routing Patterns
		$this->addSql('UPDATE RoutingPatterns SET `regExp` = CONCAT("\+", `regExp`)');
		$this->addSql('UPDATE LcrRules SET `prefix` = CONCAT("\+", `prefix`)');

		// Fix existing ACL Patterns
		$this->addSql('UPDATE GenericCallACLPatterns SET `regExp` = REPLACE(`regExp`, "^", "^+")');
		$this->addSql('UPDATE GenericCallACLPatterns SET `regExp` = REPLACE(`regExp`, "[^+", "[^")');
		$this->addSql('UPDATE CallACLPatterns SET `regExp` = REPLACE(`regExp`, "^", "^+")');
		$this->addSql('UPDATE CallACLPatterns SET `regExp` = REPLACE(`regExp`, "[^+", "[^")');

        // Remove Deprecated fields
        $this->addSql('ALTER TABLE Companies DROP areaCode, DROP outbound_prefix');
        $this->addSql('ALTER TABLE Users DROP FOREIGN KEY Users_ibfk_12');
        $this->addSql('DROP INDEX countryId ON Users');
        $this->addSql('ALTER TABLE Users DROP countryId, DROP areaCode');
        $this->addSql('ALTER TABLE Friends DROP FOREIGN KEY Friends_ibfk_2');
        $this->addSql('DROP INDEX countryId ON Friends');
        $this->addSql('ALTER TABLE Friends DROP countryId, DROP areaCode');
        $this->addSql('ALTER TABLE RetailAccounts DROP FOREIGN KEY RetailAccounts_ibfk_3');
        $this->addSql('DROP INDEX countryId ON RetailAccounts');
        $this->addSql('ALTER TABLE RetailAccounts DROP countryId, DROP areaCode');
        $this->addSql('ALTER TABLE PeeringContracts DROP FOREIGN KEY PeeringContracts_ibfk_2');
        $this->addSql('DROP INDEX PeeringContracts_ibfk_2 ON PeeringContracts');
        $this->addSql('ALTER TABLE PeeringContracts DROP transformationRulesetGroupsTrunksId');

        // Remove Deprecated tables
        $this->addSql('DROP TABLE kam_trunks_dialplan');
        $this->addSql('DROP TABLE TransformationRulesetGroupsTrunks');

        // Create view for both kamailios
        $this->addSql('CREATE VIEW kam_dialplan AS SELECT id, CAST(CONCAT(transformationRuleSetId, CASE WHEN type = "callerin" THEN 0 WHEN type = "calleein" THEN 1 WHEN type = "callerout" THEN 2 WHEN type = "calleeout" THEN 3 END) as unsigned) as dpid, priority as pr, 1 as match_op, matchExpr as match_exp, 0 as match_len, matchExpr as subst_exp, replaceExpr as repl_exp, description as attrs FROM  TransformationRules');
        $this->addSql('INSERT INTO kam_version VALUES ("kam_dialplan", 2)');

		$this->addSql('DROP VIEW kam_users');
		$this->addSql('CREATE VIEW kam_users AS SELECT E.type, E.name, E.domain, E.password, E.companyId, CONCAT(T.id,0) AS caller_in, CONCAT(T.id,1) AS callee_in, CONCAT(T.id,2) AS caller_out, CONCAT(T.id,3) AS callee_out FROM (SELECT "terminal" as type, T.name, T.domain, T.password, T.companyId, U.transformationRuleSetId FROM Terminals T INNER JOIN Users U ON U.terminalId = T.id UNION SELECT "friend" AS type, name, domain, password, companyId, transformationRuleSetId FROM Friends UNION SELECT "retail" AS type, name, domain, password, companyId, transformationRuleSetId FROM RetailAccounts) AS E INNER JOIN Companies C ON C.id = E.companyId INNER JOIN TransformationRuleSets T ON T.id = COALESCE(E.transformationRuleSetId, C.transformationRuleSetId)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');
    }
}
