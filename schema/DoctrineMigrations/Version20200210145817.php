<?php

namespace Application\Migrations;

use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20200210145817 extends LoggableMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql',
            'Migration can only be executed safely on \'mysql\'.');

        $brandEntities = $this->getBrandPublicEntities();
        $insertQuery = 'INSERT INTO `PublicEntities` (`iden`, `fqdn`, `brand`, `name_en`, `name_es`)'
        . ' VALUES (%s, %s, 1, %s, %s) ON DUPLICATE KEY UPDATE `brand` = 1';

        foreach ($brandEntities as $clientEntity) {
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
            'DELETE FROM `PublicEntities` WHERE `brand` = 1 AND `client` = 0'
        );

        $this->addSql(
            'UPDATE `PublicEntities` SET `brand` = 0'
        );

        $this->addSql(
            'INSERT INTO AdministratorRelPublicEntities (administratorId, publicEntityId, `create`, `read`, `update`, `delete`) '
            . 'SELECT A.id, P.id, 1, 1, 1, 1 FROM Administrators A INNER JOIN PublicEntities P '
            . 'WHERE A.brandId IS NOT NULL AND A.companyId IS NULL AND P.brand = 1'
        );
    }

    private function getBrandPublicEntities()
    {
        return [
            [
                '_ActiveCalls',
                'Model\ActiveCalls',
                'Active calls',
                'Llamadas activas'
            ],
            [
                '_DdiProviderRegistrationStatus',
                'Ivoz\Kam\Domain\Model\TrunksUacreg\DdiProviderRegistrationStatus',
                'Ddi provider registration status',
                'Estado de registro de proveedores DDIs'
            ],
            [
                '_RegistrationStatus',
                'Ivoz\Kam\Domain\Model\UsersLocation\RegistrationStatus',
                'Registration status',
                'Estado de registro'
            ],
            [
                'kam_users_address',
                'Ivoz\Kam\Domain\Model\UsersAddress\UsersAddress',
                'Authorized sources',
                'Redes autorizadas'
            ],
            [
                'Administrators',
                'Ivoz\Provider\Domain\Model\Administrator\Administrator',
                'Administrators',
                'Administradores'
            ],
            [
                'BalanceNotifications',
                'Ivoz\Provider\Domain\Model\BalanceNotification\BalanceNotification',
                'Balance Notifications',
                'Notificaciones Saldo'
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
                'Invoices',
                'Ivoz\Provider\Domain\Model\Invoice\Invoice',
                'Invoices',
                'Facturas',
            ],
            [
                'BrandServices',
                'Ivoz\Provider\Domain\Model\BrandService\BrandService',
                'Brand services',
                'Servicios de marca'
            ],
            [
                'CallCsvReports',
                'Ivoz\Provider\Domain\Model\CallCsvReport\CallCsvReport',
                'Call CSV reports',
                'CSVs de llamadas',
            ],
            [
                'CallCsvSchedulers',
                'Ivoz\Provider\Domain\Model\CallCsvScheduler\CallCsvScheduler',
                'Call CSV schedulers',
                'CSVs programados',
            ],
            [
                'Carriers',
                'Ivoz\Provider\Domain\Model\Carrier\Carrier',
                'Carriers',
                'Carriers'
            ],
            [
                'CarrierServers',
                'Ivoz\Provider\Domain\Model\CarrierServer\CarrierServer',
                'Carrier servers',
                'Servidores de Carrier'
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
                'Currencies',
                'Ivoz\Provider\Domain\Model\Currency\Currency',
                'Currencies',
                'Divisas'
            ],
            [
                'DDIs',
                'Ivoz\Provider\Domain\Model\Ddi\Ddi',
                'DDIs',
                'DDIs',
            ],
            [
                'DDIProviderAddresses',
                'Ivoz\Provider\Domain\Model\DdiProviderAddress\DdiProviderAddress',
                'DDI Provider Addresses',
                'Direcciones IP Proveedor'
            ],
            [
                'DDIProviders',
                'Ivoz\Provider\Domain\Model\DdiProvider\DdiProvider',
                'DDI Providers',
                'Proveedores DDIs'
            ],
            [
                'DDIProviderRegistrations',
                'Ivoz\Provider\Domain\Model\DdiProviderRegistration\DdiProviderRegistration',
                'DDI Provider Registrations',
                'Registros Proveedor'
            ],
            [
                'Destinations',
                'Ivoz\Provider\Domain\Model\Destination\Destination',
                'Destinations',
                'Destinos'
            ],
            [
                'DestinationRates',
                'Ivoz\Provider\Domain\Model\DestinationRate\DestinationRate',
                'Rates',
                'Tarifas'
            ],
            [
                'DestinationRateGroups',
                'Ivoz\Provider\Domain\Model\DestinationRateGroup\DestinationRateGroup',
                'Destination rates',
                'Precios destinos'
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
                'FeaturesRelCompanies',
                'Ivoz\Provider\Domain\Model\FeaturesRelCompany\FeaturesRelCompany',
                'Features <-> Clients',
                'Funcionalidades <-> Clientes',
            ],
            [
                'FixedCosts',
                'Ivoz\Provider\Domain\Model\FixedCost\FixedCost',
                'Fixed costs',
                'Costes fijos'
            ],
            [
                'FixedCostsRelInvoices',
                'Ivoz\Provider\Domain\Model\FixedCostsRelInvoice\FixedCostsRelInvoice',
                'Fixed costs <-> Invoices',
                'Costes fijos <-> Facturas'
            ],
            [
                'FixedCostsRelInvoiceSchedulers',
                'Ivoz\Provider\Domain\Model\FixedCostsRelInvoiceScheduler\FixedCostsRelInvoiceScheduler',
                'Fixed costs <-> Invoice schedulers',
                'Costes fijos <-> Planificadores de facturas'
            ],
            [
                'Friends',
                'Ivoz\Provider\Domain\Model\Friend\Friend',
                'Friends',
                'Friends',
            ],
            [
                'Invoices',
                'Ivoz\Provider\Domain\Model\Invoice\Invoice',
                'Invoices',
                'Facturas',
            ],
            [
                'InvoiceNumberSequences',
                'Ivoz\Provider\Domain\Model\InvoiceNumberSequence\InvoiceNumberSequence',
                'Invoice number sequences',
                'Numeraciones de facturas'
            ],
            [
                'InvoiceSchedulers',
                'Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceScheduler',
                'Invoice schedulers',
                'Planificadores de facturas'
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
                'NotificationTemplatesContents',
                'Ivoz\Provider\Domain\Model\NotificationTemplateContent\NotificationTemplateContent',
                'Notification contents',
                'Contenidos de notificaciones'
            ],
            [
                'NotificationTemplates',
                'Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplate',
                'Notification templates',
                'Plantillas de notificación',
            ],
            [
                'OutgoingRouting',
                'Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRouting',
                'Outgoing routings',
                'Rutas salientes'
            ],
            [
                'RatingPlanGroups',
                'Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroup',
                'Rating plans groups',
                'Grupos de planes de precios',
            ],
            [
                'RatingPlans',
                'Ivoz\Provider\Domain\Model\RatingPlan\RatingPlan',
                'Rates',
                'Precios'
            ],
            [
                'RatingProfiles',
                'Ivoz\Provider\Domain\Model\RatingProfile\RatingProfile',
                'Rating Plans',
                'Planes de precios',
            ],
            [
                'ResidentialDevices',
                'Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDevice',
                'Residential Devices',
                'Dispositivo residencial',
            ],
            [
                'RetailAccounts',
                'Ivoz\Provider\Domain\Model\RetailAccount\RetailAccount',
                'Retail Accounts',
                'Cuentas Retail',
            ],
            [
                'RoutingPatternGroups',
                'Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroup',
                'Routing pattern groups',
                'Grupos de patrones de ruta'
            ],
            [
                'RoutingPatternGroupsRelPatterns',
                'Ivoz\Provider\Domain\Model\RoutingPatternGroupsRelPattern\RoutingPatternGroupsRelPattern',
                'Routing pattern groups rel patterns',
                'Patrones de destino'
            ],
            [
                'RoutingPatterns',
                'Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPattern',
                'Routing patterns',
                'Patrones de ruta'
            ],
            [
                'RoutingTags',
                'Ivoz\Provider\Domain\Model\RoutingTag\RoutingTag',
                'Routing Tags',
                'Etiquetas de ruta'
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
                'Terminals',
                'Ivoz\Provider\Domain\Model\Terminal\Terminal',
                'Terminals',
                'Terminales',
            ],
            [
                'Timezones',
                'Ivoz\Provider\Domain\Model\Timezone\Timezone',
                'Time zones',
                'Zonas Horarias',
            ],
            [
                'TransformationRuleSets',
                'Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSet',
                'Numeric transformations',
                'Transformaciones numéricas',
            ],
            [
                'TransformationRules',
                'Ivoz\Provider\Domain\Model\TransformationRule\TransformationRule',
                'Transformation Rules',
                'Transformaciones numéricas'
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
