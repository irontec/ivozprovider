<?php

namespace Ivoz\Provider\Domain\Service\Domain;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Brand\BrandDto;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Service\Brand\BrandLifecycleEventHandlerInterface;

/**
 * Class DeleteByBrand
 * @package Ivoz\Provider\Domain\Service\Domain
 */
class DeleteByBrand implements BrandLifecycleEventHandlerInterface
{
    const POST_REMOVE_PRIORITY = 10;

    public function __construct(
        private EntityTools $entityTools
    ) {
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_REMOVE => self::POST_REMOVE_PRIORITY
        ];
    }

    /**
     * @return void
     */
    public function execute(BrandInterface $brand)
    {
        $domain = $brand->getDomain();

        /** @var BrandDto $brandDto */
        $brandDto = $this->entityTools->entityToDto($brand);
        $brandDto
            ->setDomain(null);

        $this
            ->entityTools
            ->updateEntityByDto(
                $brand,
                $brandDto
            );

        if ($domain) {
            $this->entityTools->remove($domain);
        }
    }
}
