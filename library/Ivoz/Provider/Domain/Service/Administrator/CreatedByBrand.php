<?php

namespace Ivoz\Provider\Domain\Service\Administrator;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Administrator\Administrator;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Service\Brand\BrandLifecycleEventHandlerInterface;

class CreatedByBrand implements BrandLifecycleEventHandlerInterface
{
    public const POST_PERSIST_PRIORITY = self::PRIORITY_NORMAL;

    public function __construct(
        private EntityTools $entityTools
    ) {
    }

    /**
     * @return array<string, int>
     */
    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => self::POST_PERSIST_PRIORITY
        ];
    }

    public function execute(BrandInterface $brand): void
    {
        $isNew = $brand->isNew();
        if (!$isNew) {
            return;
        }

        // Create a new TpDerivedCharger when brand is created
        $administratorDto = Administrator::createDto();
        /** @var int $brandId */
        $brandId = $brand->getId();
        $administratorDto
            ->setUsername(
                '__b' . $brandId . '_internal'
            )
            ->setPass(
                '[internal]'
            )
            ->setBrandId(
                $brandId
            )
            ->setActive(false)
            ->setRestricted(false)
            ->setInternal(true);

        $this->entityTools->persistDto($administratorDto, null);
    }
}
