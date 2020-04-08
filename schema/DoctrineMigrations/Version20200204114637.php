<?php

namespace Application\Migrations;

use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20200204114637 extends LoggableMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE AdministratorRelPublicEntities (id INT UNSIGNED AUTO_INCREMENT NOT NULL, administratorId INT UNSIGNED NOT NULL, publicEntityId INT UNSIGNED NOT NULL, `create` TINYINT(1) DEFAULT \'0\' NOT NULL, `read` TINYINT(1) DEFAULT \'1\' NOT NULL, `update` TINYINT(1) DEFAULT \'0\' NOT NULL, `delete` TINYINT(1) DEFAULT \'0\' NOT NULL, INDEX IDX_76F8BC9320C8F565 (publicEntityId), UNIQUE INDEX administratorRelPublicEntity_administrator_publicEntity (administratorId, publicEntityId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE PublicEntities (id INT UNSIGNED AUTO_INCREMENT NOT NULL, iden VARCHAR(100) NOT NULL, fqdn VARCHAR(200) DEFAULT NULL, platform TINYINT(1) DEFAULT \'0\' NOT NULL, brand TINYINT(1) DEFAULT \'0\' NOT NULL, client TINYINT(1) DEFAULT \'0\' NOT NULL, name_en VARCHAR(100) DEFAULT NULL, name_es VARCHAR(100) DEFAULT NULL, name_ca VARCHAR(100) DEFAULT NULL, name_it VARCHAR(100) DEFAULT NULL, UNIQUE INDEX iden (iden), UNIQUE INDEX fqdn (fqdn), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE AdministratorRelPublicEntities ADD CONSTRAINT FK_76F8BC93607ED20D FOREIGN KEY (administratorId) REFERENCES Administrators (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE AdministratorRelPublicEntities ADD CONSTRAINT FK_76F8BC9320C8F565 FOREIGN KEY (publicEntityId) REFERENCES PublicEntities (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE Administrators ADD restricted TINYINT(1) DEFAULT \'0\' NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE AdministratorRelPublicEntities DROP FOREIGN KEY FK_76F8BC9320C8F565');
        $this->addSql('DROP TABLE AdministratorRelPublicEntities');
        $this->addSql('DROP TABLE PublicEntities');
        $this->addSql('ALTER TABLE Administrators DROP restricted');
    }
}
