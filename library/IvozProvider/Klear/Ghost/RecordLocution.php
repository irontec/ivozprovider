<?php

use Ivoz\Provider\Domain\Model\CompanyService\CompanyService;
use Ivoz\Provider\Domain\Model\Service\Service;

class IvozProvider_Klear_Ghost_RecordLocution extends KlearMatrix_Model_Field_Ghost_Abstract
{
    /**
     * @param \Ivoz\Provider\Domain\Model\Locution\LocutionDTO $locutionDTO
     * @return string
     */
    public function getRecordingExtension($locutionDTO)
    {
        // Get Locution Service code
        $companyId = $locutionDTO->getCompanyId();
        $dataGateway = \Zend_Registry::get('data_gateway');

        /**
         * @var \Ivoz\Provider\Domain\Model\CompanyService\CompanyServiceDTO[] $companyServices
         */
        $companyServices = $dataGateway->findBy(
            CompanyService::class,
            [
                'CompanyService.company = :companyId',
                ['companyId' => $companyId]
            ]
        );

        // Get Recording number for this locution
        foreach ($companyServices as $companyServiceDTO) {

            /**
             * @var \Ivoz\Provider\Domain\Model\Service\ServiceDTO $service
             */
            $service = $dataGateway->find(
                Service::class,
                $companyServiceDTO->getServiceId()
            );

            if ($service->getIden() === 'RecordLocution') {
                return '*' . $companyServiceDTO->getCode() . $locutionDTO->getId();
            }
        }
    }

}
