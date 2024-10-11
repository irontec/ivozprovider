<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

/**
* Auto-generated Migration: Please modify to your needs!
*/
final class Version20241009094523 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Add ApplicationServerSets and MediaRelaySets brand relation tables';
    }

    public function up(Schema $schema): void
    {
    // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ApplicationServerSetsRelBrands (
            id INT UNSIGNED AUTO_INCREMENT NOT NULL,
            brandId INT UNSIGNED NOT NULL,
            applicationServerSetId INT UNSIGNED NOT NULL,            
            UNIQUE INDEX applicationServerSet_brand (applicationServerSetId, brandId),
            PRIMARY KEY(id))
            DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB'
        );

        $this->addSql('ALTER TABLE ApplicationServerSetsRelBrands ADD CONSTRAINT IDX_3D009C63C9049B0E FOREIGN KEY (applicationServerSetId) REFERENCES ApplicationServerSets (id) ON DELETE RESTRICT');
        $this->addSql('ALTER TABLE ApplicationServerSetsRelBrands ADD CONSTRAINT IDX_3D009C639CBEC244 FOREIGN KEY (brandId) REFERENCES Brands (id) ON DELETE CASCADE');

        $this->addSql('INSERT INTO ApplicationServerSetsRelBrands(brandId, applicationServerSetId)
                        SELECT id, 0 as applicationServerSetId FROM Brands');

        $this->addSql('CREATE TABLE MediaRelaySetsRelBrands (
            id INT UNSIGNED AUTO_INCREMENT NOT NULL,
            brandId INT UNSIGNED NOT NULL,
            mediaRelaySetId INT UNSIGNED NOT NULL,
            INDEX IDX_DFCD36A49CBEC244 (brandId),
            UNIQUE INDEX mediaRelaySet_brand (mediaRelaySetId, brandId),
            PRIMARY KEY(id))
            DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB'
        );

        $this->addSql('ALTER TABLE MediaRelaySetsRelBrands ADD CONSTRAINT FK_DFCD36A4ED1C657C FOREIGN KEY (mediaRelaySetId) REFERENCES MediaRelaySets (id) ON DELETE RESTRICT');
        $this->addSql('ALTER TABLE MediaRelaySetsRelBrands ADD CONSTRAINT FK_DFCD36A49CBEC244 FOREIGN KEY (brandId) REFERENCES Brands (id) ON DELETE CASCADE');

        $this->addSql('INSERT INTO MediaRelaySetsRelBrands(brandId, mediaRelaySetId)
                        SELECT id, 0 as applicationServerSetId FROM Brands');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE ApplicationServerSetsRelBrands');
        $this->addSql('DROP TABLE MediaRelaySetsRelBrands');
    }
}