<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\PublicEntity\PublicEntity;
use Ivoz\Provider\Domain\Model\PublicEntity\Name;

class ProviderPublicEntities extends Fixture implements FixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);

        $manager
            ->getClassMetadata(PublicEntity::class)
            ->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        $dataset = $this->getDataset();
        for ($i = 0; $i < count($dataset); $i++) {
            $publicEntity = $this->createEntityInstance(
                PublicEntity::class
            );
            $data = $dataset[$i];

            (function () use ($i, $data) {
                $name = new Name(
                    $data[0],
                    $data[0],
                    $data[0],
                    $data[0]
                );

                $this
                    ->setIden($data[0])
                    ->setFqdn($data[1])
                    ->setPlatform($data[2])
                    ->setBrand($data[3])
                    ->setClient($data[4])
                    ->setName($name);
            })->call($publicEntity);

            $this->addReference(
                '_reference_ProviderPublicEntity' . $i,
                $publicEntity
            );
            $manager->persist($publicEntity);
        }

        $manager->flush();
    }

    private function getDataset(): array
    {
        $dataset = [
            ["_RatingPlanPrices","Model\\RatingPlanPrices","0","0","1"],
            ["PublicEntitys","Ivoz\\Provider\\Domain\\Model\\PublicEntity\\PublicEntity","1","1","1"],
            ["Calendars","Ivoz\\Provider\\Domain\\Model\\Calendar\\Calendar","0","0","1"],
            ["CalendarPeriods","Ivoz\\Provider\\Domain\\Model\\CalendarPeriod\\CalendarPeriod","0","0","1"],
            ["CalendarPeriodsRelSchedules","Ivoz\\Provider\\Domain\\Model\\CalendarPeriodsRelSchedule\\CalendarPeriodsRelSchedule","0","0","1"],
            ["CallACL","Ivoz\\Provider\\Domain\\Model\\CallAcl\\CallAcl","0","0","1"],
            ["CallAclRelMatchLists","Ivoz\\Provider\\Domain\\Model\\CallAclRelMatchList\\CallAclRelMatchList","0","0","1"],
            ["CallCsvSchedulers","Ivoz\\Provider\\Domain\\Model\\CallCsvScheduler\\CallCsvScheduler","0","1","1"],
            ["CallCsvReports","Ivoz\\Provider\\Domain\\Model\\CallCsvReport\\CallCsvReport","0","1","1"],
            ["CallForwardSettings","Ivoz\\Provider\\Domain\\Model\\CallForwardSetting\\CallForwardSetting","0","0","1"],
            ["Companies","Ivoz\\Provider\\Domain\\Model\\Company\\Company","1","1","1"],
            ["CompanyServices","Ivoz\\Provider\\Domain\\Model\\CompanyService\\CompanyService","0","0","1"],
            ["ConditionalRoutes","Ivoz\\Provider\\Domain\\Model\\ConditionalRoute\\ConditionalRoute","0","0","1"],
            ["ConditionalRoutesConditions","Ivoz\\Provider\\Domain\\Model\\ConditionalRoutesCondition\\ConditionalRoutesCondition","0","0","1"],
            ["ConditionalRoutesConditionsRelMatchLists","Ivoz\\Provider\\Domain\\Model\\ConditionalRoutesConditionsRelMatchlist\\ConditionalRoutesConditionsRelMatchlist","0","0","1"],
            ["ConditionalRoutesConditionsRelSchedules","Ivoz\\Provider\\Domain\\Model\\ConditionalRoutesConditionsRelSchedule\\ConditionalRoutesConditionsRelSchedule","0","0","1"],
            ["ConditionalRoutesConditionsRelCalendars","Ivoz\\Provider\\Domain\\Model\\ConditionalRoutesConditionsRelCalendar\\ConditionalRoutesConditionsRelCalendar","0","0","1"],
            ["ConditionalRoutesConditionsRelRouteLocks","Ivoz\\Provider\\Domain\\Model\\ConditionalRoutesConditionsRelRouteLock\\ConditionalRoutesConditionsRelRouteLock","0","0","1"],
            ["ConferenceRooms","Ivoz\\Provider\\Domain\\Model\\ConferenceRoom\\ConferenceRoom","0","0","1"],
            ["Countries","Ivoz\\Provider\\Domain\\Model\\Country\\Country","1","1","1"],
            ["DDIs","Ivoz\\Provider\\Domain\\Model\\Ddi\\Ddi","0","1","1"],
            ["Extensions","Ivoz\\Provider\\Domain\\Model\\Extension\\Extension","0","0","1"],
            ["ExternalCallFilters","Ivoz\\Provider\\Domain\\Model\\ExternalCallFilter\\ExternalCallFilter","0","0","1"],
            ["ExternalCallFilterBlackLists","Ivoz\\Provider\\Domain\\Model\\ExternalCallFilterBlackList\\ExternalCallFilterBlackList","0","0","1"],
            ["ExternalCallFilterRelCalendars","Ivoz\\Provider\\Domain\\Model\\ExternalCallFilterRelCalendar\\ExternalCallFilterRelCalendar","0","0","1"],
            ["ExternalCallFilterRelSchedules","Ivoz\\Provider\\Domain\\Model\\ExternalCallFilterRelSchedule\\ExternalCallFilterRelSchedule","0","0","1"],
            ["ExternalCallFilterWhiteLists","Ivoz\\Provider\\Domain\\Model\\ExternalCallFilterWhiteList\\ExternalCallFilterWhiteList","0","0","1"],
            ["FaxesInOut","Ivoz\\Provider\\Domain\\Model\\FaxesInOut\\FaxesInOut","0","0","1"],
            ["Faxes","Ivoz\\Provider\\Domain\\Model\\Fax\\Fax","0","0","1"],
            ["Features","Ivoz\\Provider\\Domain\\Model\\Feature\\Feature","1","1","1"],
            ["FeaturesRelCompanies","Ivoz\\Provider\\Domain\\Model\\FeaturesRelCompany\\FeaturesRelCompany","0","1","1"],
            ["Friends","Ivoz\\Provider\\Domain\\Model\\Friend\\Friend","0","1","1"],
            ["FriendsPatterns","Ivoz\\Provider\\Domain\\Model\\FriendsPattern\\FriendsPattern","0","0","1"],
            ["HolidayDates","Ivoz\\Provider\\Domain\\Model\\HolidayDate\\HolidayDate","0","0","1"],
            ["HuntGroups","Ivoz\\Provider\\Domain\\Model\\HuntGroup\\HuntGroup","0","0","1"],
            ["HuntGroupsRelUsers","Ivoz\\Provider\\Domain\\Model\\HuntGroupsRelUser\\HuntGroupsRelUser","0","0","1"],
            ["Invoices","Ivoz\\Provider\\Domain\\Model\\Invoice\\Invoice","1","1","1"],
            ["IVREntries","Ivoz\\Provider\\Domain\\Model\\IvrEntry\\IvrEntry","0","0","1"],
            ["IVRs","Ivoz\\Provider\\Domain\\Model\\Ivr\\Ivr","0","0","1"],
            ["IVRExcludedExtensions","Ivoz\\Provider\\Domain\\Model\\IvrExcludedExtension\\IvrExcludedExtension","0","0","1"],
            ["Languages","Ivoz\\Provider\\Domain\\Model\\Language\\Language","1","1","1"],
            ["Locutions","Ivoz\\Provider\\Domain\\Model\\Locution\\Locution","0","0","1"],
            ["NotificationTemplates","Ivoz\\Provider\\Domain\\Model\\NotificationTemplate\\NotificationTemplate","0","1","1"],
            ["MatchLists","Ivoz\\Provider\\Domain\\Model\\MatchList\\MatchList","0","0","1"],
            ["MatchListPatterns","Ivoz\\Provider\\Domain\\Model\\MatchListPattern\\MatchListPattern","0","0","1"],
            ["MusicOnHold","Ivoz\\Provider\\Domain\\Model\\MusicOnHold\\MusicOnHold","0","0","1"],
            ["OutgoingDDIRules","Ivoz\\Provider\\Domain\\Model\\OutgoingDdiRule\\OutgoingDdiRule","0","0","1"],
            ["OutgoingDDIRulesPatterns","Ivoz\\Provider\\Domain\\Model\\OutgoingDdiRulesPattern\\OutgoingDdiRulesPattern","0","0","1"],
            ["PickUpGroups","Ivoz\\Provider\\Domain\\Model\\PickUpGroup\\PickUpGroup","0","0","1"],
            ["PickUpRelUsers","Ivoz\\Provider\\Domain\\Model\\PickUpRelUser\\PickUpRelUser","0","0","1"],
            ["QueueMembers","Ivoz\\Provider\\Domain\\Model\\QueueMember\\QueueMember","0","0","1"],
            ["Queues","Ivoz\\Provider\\Domain\\Model\\Queue\\Queue","0","0","1"],
            ["RatingPlanGroups","Ivoz\\Provider\\Domain\\Model\\RatingPlanGroup\\RatingPlanGroup","1","1","1"],
            ["RatingProfiles","Ivoz\\Provider\\Domain\\Model\\RatingProfile\\RatingProfile","0","1","1"],
            ["Recordings","Ivoz\\Provider\\Domain\\Model\\Recording\\Recording","0","0","1"],
            ["ResidentialDevices","Ivoz\\Provider\\Domain\\Model\\ResidentialDevice\\ResidentialDevice","0","1","1"],
            ["RetailAccounts","Ivoz\\Provider\\Domain\\Model\\RetailAccount\\RetailAccount","0","1","1"],
            ["RouteLocks","Ivoz\\Provider\\Domain\\Model\\RouteLock\\RouteLock","0","0","1"],
            ["Schedules","Ivoz\\Provider\\Domain\\Model\\Schedule\\Schedule","0","0","1"],
            ["Services","Ivoz\\Provider\\Domain\\Model\\Service\\Service","1","1","1"],
            ["Terminals","Ivoz\\Provider\\Domain\\Model\\Terminal\\Terminal","0","1","1"],
            ["TerminalModels","Ivoz\\Provider\\Domain\\Model\\TerminalModel\\TerminalModel","1","0","1"],
            ["Timezones","Ivoz\\Provider\\Domain\\Model\\Timezone\\Timezone","1","1","1"],
            ["TransformationRuleSets","Ivoz\\Provider\\Domain\\Model\\TransformationRuleSet\\TransformationRuleSet","0","1","1"],
            ["Users","Ivoz\\Provider\\Domain\\Model\\User\\User","0","0","1"],
            ["_ActiveCalls","Model\\ActiveCalls","1","1","0"],
            ["_DdiProviderRegistrationStatus","Ivoz\\Kam\\Domain\\Model\\TrunksUacreg\\DdiProviderRegistrationStatus","0","1","0"],
            ["_RegistrationStatus","Ivoz\\Kam\\Domain\\Model\\UsersLocation\\RegistrationStatus","0","1","0"],
            ["kam_users_address","Ivoz\\Kam\\Domain\\Model\\UsersAddress\\UsersAddress","0","1","0"],
            ["Administrators","Ivoz\\Provider\\Domain\\Model\\Administrator\\Administrator","1","1","0"],
            ["BalanceNotifications","Ivoz\\Provider\\Domain\\Model\\BalanceNotification\\BalanceNotification","0","1","0"],
            ["Brands","Ivoz\\Provider\\Domain\\Model\\Brand\\Brand","1","1","0"],
            ["BrandServices","Ivoz\\Provider\\Domain\\Model\\BrandService\\BrandService","1","1","0"],
            ["Carriers","Ivoz\\Provider\\Domain\\Model\\Carrier\\Carrier","0","1","0"],
            ["CarrierServers","Ivoz\\Provider\\Domain\\Model\\CarrierServer\\CarrierServer","0","1","0"],
            ["Currencies","Ivoz\\Provider\\Domain\\Model\\Currency\\Currency","0","1","0"],
            ["DDIProviderAddresses","Ivoz\\Provider\\Domain\\Model\\DdiProviderAddress\\DdiProviderAddress","0","1","0"],
            ["DDIProviders","Ivoz\\Provider\\Domain\\Model\\DdiProvider\\DdiProvider","0","1","0"],
            ["DDIProviderRegistrations","Ivoz\\Provider\\Domain\\Model\\DdiProviderRegistration\\DdiProviderRegistration","0","1","0"],
            ["Destinations","Ivoz\\Provider\\Domain\\Model\\Destination\\Destination","1","1","0"],
            ["DestinationRates","Ivoz\\Provider\\Domain\\Model\\DestinationRate\\DestinationRate","0","1","0"],
            ["DestinationRateGroups","Ivoz\\Provider\\Domain\\Model\\DestinationRateGroup\\DestinationRateGroup","0","1","0"],
            ["Domains","Ivoz\\Provider\\Domain\\Model\\Domain\\Domain","1","1","0"],
            ["FeaturesRelBrands","Ivoz\\Provider\\Domain\\Model\\FeaturesRelBrand\\FeaturesRelBrand","1","1","0"],
            ["FixedCosts","Ivoz\\Provider\\Domain\\Model\\FixedCost\\FixedCost","0","1","0"],
            ["FixedCostsRelInvoices","Ivoz\\Provider\\Domain\\Model\\FixedCostsRelInvoice\\FixedCostsRelInvoice","0","1","0"],
            ["FixedCostsRelInvoiceSchedulers","Ivoz\\Provider\\Domain\\Model\\FixedCostsRelInvoiceScheduler\\FixedCostsRelInvoiceScheduler","0","1","0"],
            ["InvoiceNumberSequences","Ivoz\\Provider\\Domain\\Model\\InvoiceNumberSequence\\InvoiceNumberSequence","0","1","0"],
            ["InvoiceSchedulers","Ivoz\\Provider\\Domain\\Model\\InvoiceScheduler\\InvoiceScheduler","0","1","0"],
            ["InvoiceTemplates","Ivoz\\Provider\\Domain\\Model\\InvoiceTemplate\\InvoiceTemplate","1","1","0"],
            ["NotificationTemplatesContents","Ivoz\\Provider\\Domain\\Model\\NotificationTemplateContent\\NotificationTemplateContent","0","1","0"],
            ["OutgoingRouting","Ivoz\\Provider\\Domain\\Model\\OutgoingRouting\\OutgoingRouting","0","1","0"],
            ["RatingPlans","Ivoz\\Provider\\Domain\\Model\\RatingPlan\\RatingPlan","0","1","0"],
            ["RoutingPatternGroups","Ivoz\\Provider\\Domain\\Model\\RoutingPatternGroup\\RoutingPatternGroup","0","1","0"],
            ["RoutingPatternGroupsRelPatterns","Ivoz\\Provider\\Domain\\Model\\RoutingPatternGroupsRelPattern\\RoutingPatternGroupsRelPattern","0","1","0"],
            ["RoutingPatterns","Ivoz\\Provider\\Domain\\Model\\RoutingPattern\\RoutingPattern","0","1","0"],
            ["RoutingTags","Ivoz\\Provider\\Domain\\Model\\RoutingTag\\RoutingTag","0","1","0"],
            ["SpecialNumbers","Ivoz\\Provider\\Domain\\Model\\SpecialNumber\\SpecialNumber","1","1","0"],
            ["TransformationRules","Ivoz\\Provider\\Domain\\Model\\TransformationRule\\TransformationRule","0","1","0"],
            ["WebPortals","Ivoz\\Provider\\Domain\\Model\\WebPortal\\WebPortal","1","1","0"],
            ["kam_rtpengine","Ivoz\\Kam\\Domain\\Model\\Rtpengine\\Rtpengine","1","0","0"],
            ["ApplicationServers","Ivoz\\Provider\\Domain\\Model\\ApplicationServer\\ApplicationServer","1","0","0"],
            ["MediaRelaySets","Ivoz\\Provider\\Domain\\Model\\MediaRelaySet\\MediaRelaySet","1","0","0"],
            ["ProxyTrunks","Ivoz\\Provider\\Domain\\Model\\ProxyTrunk\\ProxyTrunk","1","0","0"],
            ["ProxyUsers","Ivoz\\Provider\\Domain\\Model\\ProxyUser\\ProxyUser","1","0","0"],
            ["TerminalManufacturers","Ivoz\\Provider\\Domain\\Model\\TerminalManufacturer\\TerminalManufacturer","1","0","0"],
        ];

        return $dataset;
    }
}
