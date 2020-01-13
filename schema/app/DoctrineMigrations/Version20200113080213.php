<?php

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20200113080213 extends LoggableMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        // BillableCalls
        $this->addSql('ALTER TABLE BillableCalls DROP FOREIGN KEY FK_E6F2DA352480E723');
        $this->addSql('ALTER TABLE BillableCalls DROP FOREIGN KEY FK_E6F2DA359CBEC244');

        $this->addSql('ALTER TABLE BillableCalls MODIFY `companyId` int(10) unsigned DEFAULT NULL');
        $this->addSql('ALTER TABLE BillableCalls MODIFY `brandId` int(10) unsigned DEFAULT NULL');

        $this->addSql('ALTER TABLE BillableCalls ADD CONSTRAINT FK_E6F2DA352480E723 FOREIGN KEY (companyId) REFERENCES Companies (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE BillableCalls ADD CONSTRAINT FK_E6F2DA359CBEC244 FOREIGN KEY (brandId) REFERENCES Brands (id) ON DELETE SET NULL');

        // kam_trunks_cdrs
        $this->addSql('ALTER TABLE kam_trunks_cdrs DROP FOREIGN KEY FK_92E58EB62480E723');
        $this->addSql('ALTER TABLE kam_trunks_cdrs DROP FOREIGN KEY FK_92E58EB69CBEC244');

        $this->addSql('ALTER TABLE kam_trunks_cdrs ADD CONSTRAINT FK_92E58EB62480E723 FOREIGN KEY (companyId) REFERENCES Companies (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE kam_trunks_cdrs ADD CONSTRAINT FK_92E58EB69CBEC244 FOREIGN KEY (brandId) REFERENCES Brands (id) ON DELETE SET NULL');

        // kam_users_cdrs
        $this->addSql('ALTER TABLE kam_users_cdrs DROP FOREIGN KEY FK_238F735B2480E723');
        $this->addSql('ALTER TABLE kam_users_cdrs DROP FOREIGN KEY FK_238F735B9CBEC244');

        $this->addSql('ALTER TABLE kam_users_cdrs ADD CONSTRAINT FK_238F735B2480E723 FOREIGN KEY (companyId) REFERENCES Companies (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE kam_users_cdrs ADD CONSTRAINT FK_238F735B9CBEC244 FOREIGN KEY (brandId) REFERENCES Brands (id) ON DELETE SET NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE BillableCalls DROP FOREIGN KEY FK_E6F2DA352480E723');
        $this->addSql('ALTER TABLE BillableCalls DROP FOREIGN KEY FK_E6F2DA359CBEC244');

        $this->addSql('ALTER TABLE BillableCalls MODIFY `companyId` int(10) unsigned NOT NULL');
        $this->addSql('ALTER TABLE BillableCalls MODIFY `brandId` int(10) unsigned NOT NULL');

        $this->addSql('ALTER TABLE BillableCalls ADD CONSTRAINT FK_E6F2DA359CBEC244 FOREIGN KEY (brandId) REFERENCES Brands (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE BillableCalls ADD CONSTRAINT FK_E6F2DA352480E723 FOREIGN KEY (companyId) REFERENCES Companies (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE kam_trunks_cdrs DROP FOREIGN KEY FK_92E58EB69CBEC244');
        $this->addSql('ALTER TABLE kam_trunks_cdrs DROP FOREIGN KEY FK_92E58EB62480E723');
        $this->addSql('ALTER TABLE kam_trunks_cdrs ADD CONSTRAINT FK_92E58EB69CBEC244 FOREIGN KEY (brandId) REFERENCES Brands (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE kam_trunks_cdrs ADD CONSTRAINT FK_92E58EB62480E723 FOREIGN KEY (companyId) REFERENCES Companies (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE kam_users_cdrs DROP FOREIGN KEY FK_238F735B9CBEC244');
        $this->addSql('ALTER TABLE kam_users_cdrs DROP FOREIGN KEY FK_238F735B2480E723');
        $this->addSql('ALTER TABLE kam_users_cdrs ADD CONSTRAINT FK_238F735B9CBEC244 FOREIGN KEY (brandId) REFERENCES Brands (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE kam_users_cdrs ADD CONSTRAINT FK_238F735B2480E723 FOREIGN KEY (companyId) REFERENCES Companies (id) ON DELETE CASCADE');
    }
}
