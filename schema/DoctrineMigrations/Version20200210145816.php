<?php

namespace Application\Migrations;

use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20200210145816 extends LoggableMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $clientEntities = $this->getClientPublicEntities();
        $insertQuery = 'INSERT INTO `PublicEntities` (`iden`, `fqdn`, `client`, `name_en`, `name_es`) VALUES (%s, %s, 1, %s, %s)';

        foreach ($clientEntities as $clientEntity) {
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
            . 'WHERE A.companyId IS NOT NULL AND P.client = 1'
        );
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql(
            'DELETE FROM `PublicEntities`'
        );
    }

    private function getClientPublicEntities()
    {
        return [
            [
                '_RatingPlanPrices',
                'Model\RatingPlanPrices',
                'Prices',
                'Precios',
            ],
            [
                'BillableCalls',
                'Ivoz\Provider\Domain\Model\BillableCall\BillableCall',
                'External calls',
                'Llamadas externas',
            ],
            [
                'Calendars',
                'Ivoz\Provider\Domain\Model\Calendar\Calendar',
                'Calendars',
                'Calendarios',
            ],
            [
                'CalendarPeriods',
                'Ivoz\Provider\Domain\Model\CalendarPeriod\CalendarPeriod',
                'Calendar Periods',
                'Eventos de Horario',
            ],
            [
                'CalendarPeriodsRelSchedules',
                'Ivoz\Provider\Domain\Model\CalendarPeriodsRelSchedule\CalendarPeriodsRelSchedule',
                'Calendar Periods <-> Schedules',
                'Eventos de Horario <-> Horarios',
            ],
            [
                'CallACL',
                'Ivoz\Provider\Domain\Model\CallAcl\CallAcl',
                'Call ACLs',
                'Permisos llamada',
            ],
            [
                'CallAclRelMatchLists',
                'Ivoz\Provider\Domain\Model\CallAclRelMatchList\CallAclRelMatchList',
                'Call ACL Patterns',
                'Patrón permisos llamada',
            ],
            [
                'CallCsvSchedulers',
                'Ivoz\Provider\Domain\Model\CallCsvScheduler\CallCsvScheduler',
                'Call CSV schedulers',
                'CSVs programados',
            ],
            [
                'CallCsvReports',
                'Ivoz\Provider\Domain\Model\CallCsvReport\CallCsvReport',
                'Call CSV reports',
                'CSVs de llamadas',
            ],
            [
                'CallForwardSettings',
                'Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSetting',
                'Call forward settings',
                'Opciones de desvío',
            ],
            [
                'Companies',
                'Ivoz\Provider\Domain\Model\Company\Company',
                'Clients',
                'Clientes',
            ],
            [
                'CompanyServices',
                'Ivoz\Provider\Domain\Model\CompanyService\CompanyService',
                'Client services',
                'Servicios de cliente',
            ],
            [
                'ConditionalRoutes',
                'Ivoz\Provider\Domain\Model\ConditionalRoute\ConditionalRoute',
                'Conditional Routes',
                'Rutas condicionales',
            ],
            [
                'ConditionalRoutesConditions',
                'Ivoz\Provider\Domain\Model\ConditionalRoutesCondition\ConditionalRoutesCondition',
                'Conditional Route Conditions',
                'Condiciones de Rutas Condicionales',
            ],
            [
                'ConditionalRoutesConditionsRelMatchLists',
                'Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelMatchlist\ConditionalRoutesConditionsRelMatchlist',
                'Conditional Routes <-> Match Lists',
                'Rutas condicionales <-> Listas de coincidencia',
            ],
            [
                'ConditionalRoutesConditionsRelSchedules',
                'Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelSchedule\ConditionalRoutesConditionsRelSchedule',
                'Conditional Routes <-> Schedules',
                'Rutas condicionales <-> Horarios',
            ],
            [
                'ConditionalRoutesConditionsRelCalendars',
                'Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelCalendar\ConditionalRoutesConditionsRelCalendar',
                'Conditional Routes <-> Calendars',
                'Rutas condicionales <-> Calendarios',
            ],
            [
                'ConditionalRoutesConditionsRelRouteLocks',
                'Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelRouteLock\ConditionalRoutesConditionsRelRouteLock',
                'Conditional Routes <-> Route Locks',
                'Rutas condicionales <-> Candados',
            ],
            [
                'ConferenceRooms',
                'Ivoz\Provider\Domain\Model\ConferenceRoom\ConferenceRoom',
                'Conference rooms',
                'Salas de conferencias',
            ],
            [
                'Countries',
                'Ivoz\Provider\Domain\Model\Country\Country',
                'Countries',
                'Países',
            ],
            [
                'DDIs',
                'Ivoz\Provider\Domain\Model\Ddi\Ddi',
                'DDIs',
                'DDIs',
            ],
            [
                'Extensions',
                'Ivoz\Provider\Domain\Model\Extension\Extension',
                'Extensions',
                'Extensiones',
            ],
            [
                'ExternalCallFilters',
                'Ivoz\Provider\Domain\Model\ExternalCallFilter\ExternalCallFilter',
                'External call filters',
                'Filtros de entrada externo',
            ],
            [
                'ExternalCallFilterBlackLists',
                'Ivoz\Provider\Domain\Model\ExternalCallFilterBlackList\ExternalCallFilterBlackList',
                'External call filters <-> Black Lists',
                'Filtros de entrada externo <-> Listas negras',
            ],
            [
                'ExternalCallFilterRelCalendars',
                'Ivoz\Provider\Domain\Model\ExternalCallFilterRelCalendar\ExternalCallFilterRelCalendar',
                'External call filters <-> Calendars',
                'Filtros de entrada externo <-> Calendarios',
            ],
            [
                'ExternalCallFilterRelSchedules',
                'Ivoz\Provider\Domain\Model\ExternalCallFilterRelSchedule\ExternalCallFilterRelSchedule',
                'External call filters <-> Schedules',
                'Filtros de entrada externo <-> Horarios',
            ],
            [
                'ExternalCallFilterWhiteLists',
                'Ivoz\Provider\Domain\Model\ExternalCallFilterWhiteList\ExternalCallFilterWhiteList',
                'External call filters <-> White Lists',
                'Filtros de entrada externo <-> Listas blancas',
            ],
            [
                'FaxesInOut',
                'Ivoz\Provider\Domain\Model\FaxesInOut\FaxesInOut',
                'Faxfiles',
                'Ficheros de fax',
            ],
            [
                'Faxes',
                'Ivoz\Provider\Domain\Model\Fax\Fax',
                'Faxes',
                'Faxes',
            ],
            [
                'Features',
                'Ivoz\Provider\Domain\Model\Feature\Feature',
                'Features',
                'Funcionalidades',
            ],
            [
                'FeaturesRelCompanies',
                'Ivoz\Provider\Domain\Model\FeaturesRelCompany\FeaturesRelCompany',
                'Features <-> Clients',
                'Funcionalidades <-> Clientes',
            ],
            [
                'Friends',
                'Ivoz\Provider\Domain\Model\Friend\Friend',
                'Friends',
                'Friends',
            ],
            [
                'FriendsPatterns',
                'Ivoz\Provider\Domain\Model\FriendsPattern\FriendsPattern',
                'Friend Patterns',
                'Patrones de Friend',
            ],
            [
                'HolidayDates',
                'Ivoz\Provider\Domain\Model\HolidayDate\HolidayDate',
                'Holiday dates',
                'Festivos',
            ],
            [
                'HuntGroups',
                'Ivoz\Provider\Domain\Model\HuntGroup\HuntGroup',
                'Hunt Groups',
                'Grupos de salto',
            ],
            [
                'HuntGroupsRelUsers',
                'Ivoz\Provider\Domain\Model\HuntGroupsRelUser\HuntGroupsRelUser',
                'Hunt Groups <-> Users',
                'Grupos de salto <-> Usuarios',
            ],
            [
                'Invoices',
                'Ivoz\Provider\Domain\Model\Invoice\Invoice',
                'Invoices',
                'Facturas',
            ],
            [
                'IVREntries',
                'Ivoz\Provider\Domain\Model\IvrEntry\IvrEntry',
                'IVR entries',
                'Entradas IVR',
            ],
            [
                'IVRs',
                'Ivoz\Provider\Domain\Model\Ivr\Ivr',
                'IVRs',
                'IVRs',
            ],
            [
                'IVRExcludedExtensions',
                'Ivoz\Provider\Domain\Model\IvrExcludedExtension\IvrExcludedExtension',
                'IVR Excluded Extensions',
                'IVR Extensiones excluidas',
            ],
            [
                'Languages',
                'Ivoz\Provider\Domain\Model\Language\Language',
                'Languages',
                'Idiomas',
            ],
            [
                'Locutions',
                'Ivoz\Provider\Domain\Model\Locution\Locution',
                'Locutions',
                'Locuciones',
            ],
            [
                'NotificationTemplates',
                'Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplate',
                'Notification templates',
                'Plantillas de notificación',
            ],
            [
                'MatchLists',
                'Ivoz\Provider\Domain\Model\MatchList\MatchList',
                'Match Lists',
                'Listas de ',
            ],
            [
                'MatchListPatterns',
                'Ivoz\Provider\Domain\Model\MatchListPattern\MatchListPattern',
                'Match List Patterns',
                'Patrones lista de coincidencia',
            ],
            [
                'MusicOnHold',
                'Ivoz\Provider\Domain\Model\MusicOnHold\MusicOnHold',
                'Musics on Hold',
                'Músicas en espera',
            ],
            [
                'OutgoingDDIRules',
                'Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRule',
                'Outgoing DDI Rules',
                'Reglas DDI de salida',
            ],
            [
                'OutgoingDDIRulesPatterns',
                'Ivoz\Provider\Domain\Model\OutgoingDdiRulesPattern\OutgoingDdiRulesPattern',
                'Outgoing DDI Rule Patterns',
                'Patrones de regla DDI de salida',
            ],
            [
                'PickUpGroups',
                'Ivoz\Provider\Domain\Model\PickUpGroup\PickUpGroup',
                'Pick up groups',
                'Grupos de captura',
            ],
            [
                'PickUpRelUsers',
                'Ivoz\Provider\Domain\Model\PickUpRelUser\PickUpRelUser',
                'Pick up <->> users',
                'Grupos de captura <-> Usuarios',
            ],
            [
                'QueueMembers',
                'Ivoz\Provider\Domain\Model\QueueMember\QueueMember',
                'Queue Members',
                'Miembros de cola',
            ],
            [
                'Queues',
                'Ivoz\Provider\Domain\Model\Queue\Queue',
                'Queues',
                'Colas',
            ],
            [
                'RatingPlanGroups',
                'Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroup',
                'Rating plans groups',
                'Grupos de planes de precios',
            ],
            [
                'RatingProfiles',
                'Ivoz\Provider\Domain\Model\RatingProfile\RatingProfile',
                'Rating Plans',
                'Planes de precios',
            ],
            [
                'Recordings',
                'Ivoz\Provider\Domain\Model\Recording\Recording',
                'Recordings',
                'Grabaciones',
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
                'RouteLocks',
                'Ivoz\Provider\Domain\Model\RouteLock\RouteLock',
                'Route Locks',
                'Candados',
            ],
            [
                'Schedules',
                'Ivoz\Provider\Domain\Model\Schedule\Schedule',
                'Schedules',
                'Horarios',
            ],
            [
                'Services',
                'Ivoz\Provider\Domain\Model\Service\Service',
                'Services',
                'Servicios',
            ],
            [
                'Terminals',
                'Ivoz\Provider\Domain\Model\Terminal\Terminal',
                'Terminals',
                'Terminales',
            ],
            [
                'TerminalModels',
                'Ivoz\Provider\Domain\Model\TerminalModel\TerminalModel',
                'Terminal models',
                'Modelos de Terminales',
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
                'Users',
                'Ivoz\Provider\Domain\Model\User\User',
                'Users',
                'Usuarios',
            ],
        ];
    }
}
