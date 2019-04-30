<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180509163441 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE Codecs (id INT UNSIGNED AUTO_INCREMENT NOT NULL, type VARCHAR(10) DEFAULT \'audio\' NOT NULL COMMENT \'[enum:audio|video]\', iden VARCHAR(25) NOT NULL, name VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE CompaniesRelCodecs (id INT UNSIGNED AUTO_INCREMENT NOT NULL, companyId INT UNSIGNED NOT NULL, codecId INT UNSIGNED NOT NULL, INDEX IDX_BF72F1B22480E723 (companyId), INDEX IDX_BF72F1B29F2FC641 (codecId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE CompaniesRelCodecs ADD CONSTRAINT FK_BF72F1B22480E723 FOREIGN KEY (companyId) REFERENCES Companies (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE CompaniesRelCodecs ADD CONSTRAINT FK_BF72F1B29F2FC641 FOREIGN KEY (codecId) REFERENCES Codecs (id) ON DELETE CASCADE');

        // Add Supported codecs
        $this->addSql("INSERT INTO Codecs VALUES (1,'audio','PCMA','G.711 a-law'),(2,'audio','PCMU','G.711 u-law'),(3,'audio','GSM','GSM'),(4,'audio','G729','G.729A'),(5,'audio','opus','Opus'),(6,'audio','G723','G.723.1'),(7,'audio','G722','G.722'),(8,'audio','speex','Speex'),(9,'audio','iLBC','iLBC'),(10,'audio','AMR','AMR'),(11,'audio','AMR-WB','AMR-WB')");

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE CompaniesRelCodecs DROP FOREIGN KEY FK_BF72F1B29F2FC641');
        $this->addSql('DROP TABLE Codecs');
        $this->addSql('DROP TABLE CompaniesRelCodecs');
    }
}
