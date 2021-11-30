<?php

namespace Ivoz\Kam\Domain\Model\UsersCdr;

use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\Friend\FriendInterface;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface;
use Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface;

/**
* UsersCdrInterface
*/
interface UsersCdrInterface extends EntityInterface
{
    /**
     * Get id
     *
     * @return integer
     */
    public function getId(): ?int;

    /**
     * @return string
     */
    public function getOwner(): ?string;

    /**
     * @return string
     */
    public function getParty(): ?string;

    public static function createDto(string|int|null $id = null): UsersCdrDto;

    /**
     * @internal use EntityTools instead
     * @param null|UsersCdrInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?UsersCdrDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param UsersCdrDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): UsersCdrDto;

    public function getStartTime(): \DateTime;

    public function getEndTime(): \DateTime;

    public function getDuration(): float;

    public function getDirection(): ?string;

    public function getCaller(): ?string;

    public function getCallee(): ?string;

    public function getDiversion(): ?string;

    public function getReferee(): ?string;

    public function getReferrer(): ?string;

    public function getCallid(): ?string;

    public function getCallidHash(): ?string;

    public function getXcallid(): ?string;

    public function getHidden(): bool;

    public function getBrand(): ?BrandInterface;

    public function getCompany(): ?CompanyInterface;

    public function getUser(): ?UserInterface;

    public function getFriend(): ?FriendInterface;

    public function getResidentialDevice(): ?ResidentialDeviceInterface;

    public function getRetailAccount(): ?RetailAccountInterface;

    public function isInitialized(): bool;
}
