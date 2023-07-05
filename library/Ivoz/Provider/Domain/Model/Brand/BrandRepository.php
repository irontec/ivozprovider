<?php

namespace Ivoz\Provider\Domain\Model\Brand;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

interface BrandRepository extends ObjectRepository, Selectable
{
    /**
     * @return string[]
     */
    public function getNames();

    public function findOneByDomain(string $domainUsers): ?BrandInterface;

    /**
     * @param array<string, mixed> $criteria
     */
    public function count(array $criteria): int;

    /**
     * @return BrandInterface[]
     */
    public function getLatest(int $intemNum = 5): array;
}
