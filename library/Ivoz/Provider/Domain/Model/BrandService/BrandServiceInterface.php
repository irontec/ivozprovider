<?php

namespace Ivoz\Provider\Domain\Model\BrandService;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Service\ServiceInterface;

/**
* BrandServiceInterface
*/
interface BrandServiceInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet(): array;

    /**
     * {@inheritDoc}
     */
    public function setCode(string $code): static;

    public function getCode(): string;

    public function setBrand(BrandInterface $brand): static;

    public function getBrand(): BrandInterface;

    public function getService(): ServiceInterface;

    public function isInitialized(): bool;
}
