<?php

namespace Ivoz\Provider\Domain\Service\Domain;

use Doctrine\ORM\EntityManagerInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Service\Brand\BrandLifecycleEventHandlerInterface;

/**
 * Class DeleteByBrand
 * @package Ivoz\Provider\Domain\Service\Domain
 */
class DeleteByBrand implements BrandLifecycleEventHandlerInterface
{
    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * DeleteByBrand constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(
        EntityManagerInterface $em
    ) {
        $this->em = $em;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_REMOVE => 10
        ];
    }

    /**
     * @return void
     */
    public function execute(BrandInterface $brand)
    {
        $domain = $brand->getDomain();
        $brand->setDomain(null);

        if ($domain) {
            $this->em->remove($domain);
        }
    }
}
