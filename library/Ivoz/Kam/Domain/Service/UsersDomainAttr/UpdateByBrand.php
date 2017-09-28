<?php
namespace Ivoz\Kam\Domain\Service\UsersDomainAttr;

use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Service\Brand\BrandLifecycleEventHandlerInterface;
use Ivoz\Kam\Domain\Model\UsersDomainAttr\UsersDomainAttrRepository;
use Ivoz\Kam\Domain\Model\UsersDomainAttr\UsersDomainAttr;
use Ivoz\Kam\Domain\Model\UsersDomainAttr\UsersDomainAttrDTO;

/**
 * Class UpdateByBrand
 * @package Ivoz\Kam\Domain\Service\UsersDomainAttr
 * @lifecycle post_persist
 */
class UpdateByBrand implements BrandLifecycleEventHandlerInterface
{
    /**
     * @var EntityPersisterInterface
     */
    protected $entityPersister;

    /**
     * @var DomainRepository
     */
    protected $usersDomainAttrRepository;

    public function __construct(
        EntityPersisterInterface $entityPersister,
        UsersDomainAttrRepository $usersDomainAttrRepository
    ) {
        $this->entityPersister = $entityPersister;
        $this->usersDomainAttrRepository = $usersDomainAttrRepository;
    }

    public function execute(BrandInterface $entity, $isNew)
    {
        if (!$entity->hasChanged('domainUsers')) {
            return;
        }

        $domainName = $entity->getDomainUsers();

        if (!empty($domainName)) {

            $domainsAttr = $this->usersDomainAttrRepository->findBy([
                'did' => $domainName,
                'name' => 'brandId'
            ]);

            if (empty($domainsAttr)) {
                /**
                 * @var UsersDomainAttrDTO $domainAttrDto
                 */
                $domainAttrDto = UsersDomainAttr::createDTO();
                $domainAttrDto
                    ->setDid($domainName)
                    ->setName('brandId')
                    ->setType('0')
                    ->setValue((string) $entity->getId());

                $this->entityPersister->persistDto($domainAttrDto);
            }
        }
    }
}