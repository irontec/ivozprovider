<?php

namespace Ivoz\Provider\Domain\Service\CallAclPattern;

use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Doctrine\ORM\EntityManagerInterface;
use Ivoz\Provider\Domain\Model\Brand\Brand;
use Ivoz\Provider\Domain\Model\CallAclPattern\CallAclPattern;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\GenericCallAclPattern\GenericCallAclPattern;
use Ivoz\Provider\Domain\Service\Company\CompanyLifecycleEventHandlerInterface;

/**
 * Class PropagateBrandGenericCallAclPatterns
 * @package Ivoz\Provider\Domain\Service\CallAclPattern
 * @lifecycle pre_persist
 */
class PropagateBrandGenericCallAclPatterns implements CompanyLifecycleEventHandlerInterface
{
    /**
     * @var EntityPersisterInterface
     */
    protected $entityPersister;

    public function __construct(
        EntityPersisterInterface $entityPersister
    ) {
        $this->entityPersister = $entityPersister;
    }

    /**
     * @throws \Exception
     */
    public function execute(CompanyInterface $entity, $isNew)
    {
        if (!$isNew) {
            return;
        }

        $companyDto = $entity->toDTO();
        /**
         * @var Brand $brand
         */
        $brand = $entity->getBrand();
        if (is_null($brand)) {
            throw new \Exception(_("Brand is not set"), 60000);
        }

        /**
         * We can avoid one query here using the repository directly
         */
        $genericCallAclPatterns = $brand->getGenericCallAclPatterns();
        $callAclPatterns = array();

        /**
         * @var GenericCallAclPattern $genericCallAclPattern
         */
        foreach ($genericCallAclPatterns as $genericCallAclPattern) {

            $callAclPatternDto = CallAclPattern::createDTO();
            $callAclPatternDto
                /* @todo ensure that this works as expected, this is not the real company id
                 * because is not persisted yet.
                 */
                ->setCompanyId($companyDto->getId())
                ->setName($genericCallAclPattern->getName())
                ->setRegExp($genericCallAclPattern->getRegExp());

            $callAclPatterns[] = $callAclPatternDto;
        }

        if (!empty($callAclPatterns)) {
            // @todo check whether cascade: ['persist']/ other is necessary
            $companyDto->setCallAclPatterns($callAclPatterns);
            $this->entityPersister->persistDto($companyDto, $entity);
        }
    }
}