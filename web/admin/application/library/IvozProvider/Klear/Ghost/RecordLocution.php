<?php

use Ivoz\Provider\Domain\Model\CompanyService\CompanyService;
use Ivoz\Provider\Domain\Model\CompanyService\CompanyServiceDto;
use Ivoz\Provider\Domain\Model\Locution\LocutionDto;
use Ivoz\Provider\Domain\Model\Service\Service;
use Ivoz\Provider\Domain\Model\Service\ServiceDto;

class IvozProvider_Klear_Ghost_RecordLocution extends KlearMatrix_Model_Field_Ghost_Abstract
{
    /**
     * @param LocutionDto $locutionDto
     * @return string
     * @throws Zend_Exception
     */
    public function getRecordingExtension($locutionDto)
    {
        // Get Locution Service code
        $companyId = $locutionDto->getCompanyId();
        $dataGateway = \Zend_Registry::get('data_gateway');

        /**
         * @var CompanyServiceDto[] $companyServices
         */
        $companyServices = $dataGateway->findBy(
            CompanyService::class,
            [
                'CompanyService.company = :companyId',
                ['companyId' => $companyId]
            ]
        );

        // Get Recording number for this locution
        foreach ($companyServices as $companyServiceDto) {

            /**
             * @var ServiceDto $service
             */
            $service = $dataGateway->find(
                Service::class,
                $companyServiceDto->getServiceId()
            );

            if ($service->getIden() === 'RecordLocution') {
                return '*' . $companyServiceDto->getCode() . $locutionDto->getId();
            }
        }

        return "";
    }
}
