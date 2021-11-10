<?php

namespace Ivoz\Provider\Domain\Model\MatchList;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\MatchListPattern\MatchListPatternInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

/**
* MatchListInterface
*/
interface MatchListInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet(): array;

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId(): ?int;

    /**
     * Check if the given number matches the list rules
     *
     * @param string $number in E164 form
     * @return bool true if number matches, false otherwise
     */
    public function numberMatches($number);

    public static function createDto(string|int|null $id = null): MatchListDto;

    /**
     * @internal use EntityTools instead
     * @param null|MatchListInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?MatchListDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): MatchListDto;

    public function getName(): string;

    public function setBrand(?BrandInterface $brand = null): static;

    public function getBrand(): ?BrandInterface;

    public function getCompany(): ?CompanyInterface;

    public function isInitialized(): bool;

    public function addPattern(MatchListPatternInterface $pattern): MatchListInterface;

    public function removePattern(MatchListPatternInterface $pattern): MatchListInterface;

    public function replacePatterns(ArrayCollection $patterns): MatchListInterface;

    public function getPatterns(?Criteria $criteria = null): array;
}
