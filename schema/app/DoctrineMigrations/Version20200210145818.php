<?php

namespace Application\Migrations;

use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20200210145818 extends LoggableMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql',
            'Migration can only be executed safely on \'mysql\'.');

        $platformEntities = $this->getPlatformPublicEntities();
        $insertQuery = 'INSERT INTO `PublicEntities` (`iden`, `fqdn`, `platform`, `name_en`, `name_es`)'
        . ' VALUES (%s, %s, 1, %s, %s) ON DUPLICATE KEY UPDATE `platform` = 1';

        foreach ($platformEntities as $clientEntity) {
            list ($iden, $fqdn, $nameEn, $nameEs) = $clientEntity;
            $query = sprintf(
                $insertQuery,
                $this->connection->quote($iden),
                $this->connection->quote($fqdn),
                $this->connection->quote($nameEn),
                $this->connection->quote($nameEs)
            );

            $this->addSql($query);
        }

        $this->addSql(
            'UPDATE `PublicEntities` SET name_it = name_en, name_ca = name_es'
        );

        $this->addSql(
            'INSERT INTO AdministratorRelPublicEntities (administratorId, publicEntityId, `create`, `read`, `update`, `delete`) '
            . 'SELECT A.id, P.id, 1, 1, 1, 1 FROM Administrators A INNER JOIN PublicEntities P '
            . 'WHERE A.brandId IS NULL AND A.companyId IS NULL AND P.platform = 1'
        );
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql',
            'Migration can only be executed safely on \'mysql\'.');

        $this->addSql(
            'DELETE FROM `PublicEntities` WHERE `platform` = 1 AND `brand` = 0 AND `client` = 0'
        );

        $this->addSql(
            'UPDATE `PublicEntities` SET `platform` = 0'
        );
    }

    private function getPlatformPublicEntities()
    {
        return [
            [
                '_ActiveCalls',
                'Model\ActiveCalls',
                'Active calls',
                'Llamadas activas'
            ],
            [
                'Administrators',
                'Ivoz\Provider\Domain\Model\Administrator\Administrator',
                'Administrators',
                'Administradores'
            ],
            [
                'kam_rtpengine',
                'Ivoz\Kam\Domain\Model\Rtpengine\Rtpengine',
                'Media relays',
                'Servidores de media'
            ],
            [
                'ApplicationServers',
                'Ivoz\Provider\Domain\Model\ApplicationServer\ApplicationServer',
                'Application Servers',
                'Servidores de Aplicación'
            ],
            [
                'BillableCalls',
                'Ivoz\Provider\Domain\Model\BillableCall\BillableCall',
                'External calls',
                'Llamadas externas',
            ],
            [
                'Brands',
                'Ivoz\Provider\Domain\Model\Brand\Brand',
                'Brands',
                'Marcas'
            ],
            [
                'BrandServices',
                'Ivoz\Provider\Domain\Model\BrandService\BrandService',
                'Brand services',
                'Servicios de marca'
            ],
            [
                'Companies',
                'Ivoz\Provider\Domain\Model\Company\Company',
                'Clients',
                'Clientes',
            ],
            [
                'Countries',
                'Ivoz\Provider\Domain\Model\Country\Country',
                'Countries',
                'Países',
            ],
            [
                'Destinations',
                'Ivoz\Provider\Domain\Model\Destination\Destination',
                'Destinations',
                'Destinos'
            ],
            [
                'Domains',
                'Ivoz\Provider\Domain\Model\Domain\Domain',
                'Domains',
                'Dominios'
            ],
            [
                'Features',
                'Ivoz\Provider\Domain\Model\Feature\Feature',
                'Features',
                'Funcionalidades',
            ],
            [
                'FeaturesRelBrands',
                'Ivoz\Provider\Domain\Model\FeaturesRelBrand\FeaturesRelBrand',
                'Features <-> Brands',
                'Funcionalidades <-> Marcas'
            ],
            [
                'Invoices',
                'Ivoz\Provider\Domain\Model\Invoice\Invoice',
                'Invoices',
                'Facturas',
            ],
            [
                'InvoiceTemplates',
                'Ivoz\Provider\Domain\Model\InvoiceTemplate\InvoiceTemplate',
                'Invoice templates',
                'Plantillas de facturas'
            ],
            [
                'Languages',
                'Ivoz\Provider\Domain\Model\Language\Language',
                'Languages',
                'Idiomas',
            ],
            [
                'MediaRelaySets',
                'Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySet',
                'Media relay sets',
                'Servidores de Media'
            ],
            [
                'ProxyTrunks',
                'Ivoz\Provider\Domain\Model\ProxyTrunk\ProxyTrunk',
                'Proxies Trunks',
                'Proxies de Salida'
            ],
            [
                'ProxyUsers',
                'Ivoz\Provider\Domain\Model\ProxyUser\ProxyUser',
                'Proxies Users',
                'Proxies de Usuarios'
            ],
            [
                'RatingPlanGroups',
                'Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroup',
                'Rating plans groups',
                'Grupos de planes de precios',
            ],
            [
                'Services',
                'Ivoz\Provider\Domain\Model\Service\Service',
                'Services',
                'Servicios',
            ],
            [
                'SpecialNumbers',
                'Ivoz\Provider\Domain\Model\SpecialNumber\SpecialNumber',
                'Special Numbers',
                'Números especiales'
            ],
            [
                'TerminalManufacturers',
                'Ivoz\Provider\Domain\Model\TerminalManufacturer\TerminalManufacturer',
                'Terminal manufacturers',
                'Fabricantes de Terminales'
            ],
            [
                'TerminalModels',
                'Ivoz\Provider\Domain\Model\TerminalModel\TerminalModel',
                'Terminal models',
                'Modelos de Terminales'
            ],
            [
                'Timezones',
                'Ivoz\Provider\Domain\Model\Timezone\Timezone',
                'Time zones',
                'Zonas Horarias',
            ],
            [
                'WebPortals',
                'Ivoz\Provider\Domain\Model\WebPortal\WebPortal',
                'Web Portals',
                'Portales Web'
            ],
        ];
    }
}
