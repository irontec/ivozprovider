<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180322122500 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE BalanceMovements (
                            id INT UNSIGNED AUTO_INCREMENT NOT NULL,
                            amount NUMERIC(10, 4) DEFAULT \'0\',
                            balance NUMERIC(10, 4) DEFAULT \'0\',
                            createdOn DATETIME DEFAULT CURRENT_TIMESTAMP COMMENT \'(DC2Type:datetime)\',
                            companyId INT UNSIGNED NOT NULL,
                            INDEX IDX_A8AD782F2480E723 (companyId),
                            PRIMARY KEY(id)
                        ) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');

        $this->addSql('ALTER TABLE BalanceMovements ADD CONSTRAINT FK_758E03912480E723 FOREIGN KEY (companyId) REFERENCES Companies (id) ON DELETE CASCADE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE BalanceMovements');
    }
}
