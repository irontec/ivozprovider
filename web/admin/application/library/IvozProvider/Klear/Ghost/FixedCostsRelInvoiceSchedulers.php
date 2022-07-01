<?php

use Ivoz\Core\Application\Service\DataGateway;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Country\Country;
use Ivoz\Provider\Domain\Model\FixedCostsRelInvoiceScheduler\FixedCostsRelInvoiceSchedulerDto;
use Ivoz\Provider\Domain\Model\FixedCostsRelInvoiceScheduler\FixedCostsRelInvoiceSchedulerInterface;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceDto;

class IvozProvider_Klear_Ghost_FixedCostsRelInvoiceSchedulers extends KlearMatrix_Model_Field_Ghost_Abstract
{
    /**
     * @param FixedCostsRelInvoiceSchedulerDto $fixedCostsRelInvoiceScheduler
     * @return mixed|string
     * @throws Exception
     */
    public function getQuantity(FixedCostsRelInvoiceSchedulerDto $fixedCostsRelInvoiceScheduler)
    {
        if ($fixedCostsRelInvoiceScheduler->getType() == FixedCostsRelInvoiceSchedulerInterface::TYPE_STATIC) {
            return $fixedCostsRelInvoiceScheduler->getQuantity();
        }

        if ($fixedCostsRelInvoiceScheduler->getType() == FixedCostsRelInvoiceSchedulerInterface::TYPE_MAXCALLS) {
            return _("Client's Max Calls setting");
        }

        if ($fixedCostsRelInvoiceScheduler->getType() == FixedCostsRelInvoiceSchedulerInterface::TYPE_DDIS) {
            $ddiCountryMatch = $fixedCostsRelInvoiceScheduler->getDdisCountryMatch();
            // Any Country
            if ($ddiCountryMatch == FixedCostsRelInvoiceSchedulerInterface::DDISCOUNTRYMATCH_ALL) {
                return _("DDIs from any country");
            }
            // Client Country
            if ($ddiCountryMatch == FixedCostsRelInvoiceSchedulerInterface::DDISCOUNTRYMATCH_NATIONAL) {
                return _("DDIs from client's country");
            }
            // Not client Country
            if ($ddiCountryMatch == FixedCostsRelInvoiceSchedulerInterface::DDISCOUNTRYMATCH_INTERNATIONAL) {
                return _("DDIs NOT from client's country");
            }

            if ($ddiCountryMatch == FixedCostsRelInvoiceSchedulerInterface::DDISCOUNTRYMATCH_SPECIFIC) {
                // Specific Country DDI Matching
                /** @var DataGateway $dataGateway */
                $dataGateway = \Zend_Registry::get('data_gateway');

                /** @var \Ivoz\Provider\Domain\Model\Country\Name $countryName */
                $countryName = $dataGateway->remoteProcedureCall(
                    Country::class,
                    $fixedCostsRelInvoiceScheduler->getDdisCountryId(),
                    'getName',
                    []
                );

                $countryCode = $dataGateway->remoteProcedureCall(
                    Country::class,
                    $fixedCostsRelInvoiceScheduler->getDdisCountryId(),
                    'getCountryCode',
                    []
                );

                return sprintf(_("DDIs from %s (%s)"), $countryName->getEn(), $countryCode);
            }
        }

        return "";
    }
}
