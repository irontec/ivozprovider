<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171109171316 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE XMLRPCLogs');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE XMLRPCLogs (id INT UNSIGNED AUTO_INCREMENT NOT NULL, proxy VARCHAR(10) NOT NULL COLLATE utf8_general_ci, module VARCHAR(10) NOT NULL COLLATE utf8_general_ci, method VARCHAR(10) NOT NULL COLLATE utf8_general_ci, mapperName VARCHAR(20) NOT NULL COLLATE utf8_general_ci, startDate DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, execDate DATETIME DEFAULT NULL, finishDate DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
    }
}
