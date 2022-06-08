<?php

namespace Ivoz\Provider\Domain\Model\TransformationRuleSet;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;
use Ivoz\Provider\Domain\Model\TransformationRule\TransformationRuleInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;

/**
* TransformationRuleSetInterface
*/
interface TransformationRuleSetInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array<string, mixed>
     */
    public function getChangeSet(): array;

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId(): ?int;

    /**
     * {@inheritDoc}
     */
    public function setInternationalCode(?string $internationalCode = null): static;

    /**
     * {@inheritDoc}
     */
    public function setTrunkPrefix(?string $trunkPrefix = null): static;

    public static function createDto(string|int|null $id = null): TransformationRuleSetDto;

    /**
     * @internal use EntityTools instead
     * @param null|TransformationRuleSetInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?TransformationRuleSetDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param TransformationRuleSetDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): TransformationRuleSetDto;

    public function getDescription(): ?string;

    public function getInternationalCode(): ?string;

    public function getTrunkPrefix(): ?string;

    public function getAreaCode(): ?string;

    public function getNationalLen(): ?int;

    public function getGenerateRules(): ?bool;

    public function getName(): Name;

    public function getBrand(): ?BrandInterface;

    public function getCountry(): ?CountryInterface;

    public function isInitialized(): bool;

    public function addRule(TransformationRuleInterface $rule): TransformationRuleSetInterface;

    public function removeRule(TransformationRuleInterface $rule): TransformationRuleSetInterface;

    /**
     * @param Collection<array-key, TransformationRuleInterface> $rules
     */
    public function replaceRules(Collection $rules): TransformationRuleSetInterface;

    /**
     * @return array<array-key, TransformationRuleInterface>
     */
    public function getRules(?Criteria $criteria = null): array;
}
