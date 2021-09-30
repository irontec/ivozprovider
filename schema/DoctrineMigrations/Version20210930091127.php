<?php

namespace Application\Migrations;

use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20210930091127 extends LoggableMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql(
            'UPDATE Brands SET currencyId = (SELECT id FROM Currencies WHERE iden = \'EUR\') WHERE currencyId IS NULL'
        );

        $this->addSql('ALTER TABLE Brands DROP FOREIGN KEY FK_790E410291000B8A');
        $this->addSql('ALTER TABLE Brands CHANGE currencyId currencyId INT UNSIGNED NOT NULL');
        $this->addSql('ALTER TABLE Brands ADD CONSTRAINT FK_790E410291000B8A FOREIGN KEY (currencyId) REFERENCES Currencies (id) ON DELETE RESTRICT');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Brands DROP FOREIGN KEY FK_790E410291000B8A');
        $this->addSql('ALTER TABLE Brands CHANGE currencyId currencyId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE Brands ADD CONSTRAINT FK_790E410291000B8A FOREIGN KEY (currencyId) REFERENCES Currencies (id) ON DELETE SET NULL');
    }
}
