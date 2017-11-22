<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171121150822 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Users CHANGE externalIpCalls externalIpCalls VARCHAR(1) DEFAULT \'0\' NOT NULL COMMENT \'[enum:0|1|2|3]\'');
        $this->addSql('ALTER TABLE Users ADD bossAssistantWhiteListId INT UNSIGNED DEFAULT NULL, DROP exceptionBoosAssistantRegExp');
        $this->addSql('ALTER TABLE Users ADD CONSTRAINT FK_D5428AED6FA2F8E7 FOREIGN KEY (bossAssistantWhiteListId) REFERENCES MatchLists (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_D5428AED6FA2F8E7 ON Users (bossAssistantWhiteListId)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Users DROP FOREIGN KEY FK_D5428AED6FA2F8E7');
        $this->addSql('DROP INDEX IDX_D5428AED6FA2F8E7 ON Users');
        $this->addSql('ALTER TABLE Users ADD exceptionBoosAssistantRegExp VARCHAR(255) DEFAULT NULL, DROP bossAssistantWhiteListId');
        $this->addSql('ALTER TABLE Users CHANGE externalIpCalls externalIpCalls TINYINT(1) DEFAULT \'0\' NOT NULL COMMENT \'[enum:0|1|2|3]\'');
    }
}
