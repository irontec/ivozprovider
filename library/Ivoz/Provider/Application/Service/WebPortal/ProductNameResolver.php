<?php

namespace Ivoz\Provider\Application\Service\WebPortal;

use Ivoz\Provider\Domain\Model\WebPortal\WebPortalRepository;
use Ivoz\Provider\Domain\Model\WebPortal\WebPortalInterface;

class ProductNameResolver
{
    private const DEFAULT_PRODUCT_NAME = 'Ivoz Provider';

    public function __construct(
        private WebPortalRepository $webPortalRepository
    ) {
    }

    public function execute(string $hostname, string $urlType): string
    {
        if (!$hostname) {
            return self::DEFAULT_PRODUCT_NAME;
        }

        $webPortal = $this->webPortalRepository->findByServerNameAndType(
            $hostname,
            $urlType
        );

        if (!$webPortal) {
            return self::DEFAULT_PRODUCT_NAME;
        }

        $productName = $webPortal->getProductName();
        return $productName ?: self::DEFAULT_PRODUCT_NAME;
    }
}
