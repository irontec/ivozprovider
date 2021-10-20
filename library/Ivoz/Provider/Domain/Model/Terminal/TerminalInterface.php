<?php

namespace Ivoz\Provider\Domain\Model\Terminal;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Domain\DomainInterface;
use Ivoz\Provider\Domain\Model\TerminalModel\TerminalModelInterface;
use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface;
use Ivoz\Ast\Domain\Model\PsIdentify\PsIdentifyInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

/**
* TerminalInterface
*/
interface TerminalInterface extends LoggableEntityInterface
{
    public const DIRECTMEDIAMETHOD_UPDATE = 'update';

    public const DIRECTMEDIAMETHOD_INVITE = 'invite';

    public const DIRECTMEDIAMETHOD_REINVITE = 'reinvite';

    public const T38PASSTHROUGH_YES = 'yes';

    public const T38PASSTHROUGH_NO = 'no';

    /**
     * @return array
     */
    public function getChangeSet();

    /**
     * {@inheritDoc}
     * @throws \InvalidArgumentException
     */
    public function setName(?string $name = null): static;

    /**
     * {@inheritDoc}
     * @throws \InvalidArgumentException
     */
    public function setPassword(string $password): static;

    public static function randomPassword(): string;

    public function getUser();

    /**
     * @return string
     */
    public function getContact(): string;

    /**
     * @return string
     */
    public function getSorcery(): string;

    /**
     * @return string
     */
    public function getAllow();

    public function setMac(?string $mac = null): static;

    public function getName(): string;

    public function getDisallow(): string;

    public function getAllowAudio(): string;

    public function getAllowVideo(): ?string;

    public function getDirectMediaMethod(): string;

    public function getPassword(): string;

    public function getMac(): ?string;

    /**
     * @return \DateTime|\DateTimeImmutable
     */
    public function getLastProvisionDate(): ?\DateTimeInterface;

    public function getT38Passthrough(): string;

    public function getRtpEncryption(): bool;

    public function setCompany(CompanyInterface $company): static;

    public function getCompany(): CompanyInterface;

    public function setDomain(?DomainInterface $domain = null): static;

    public function getDomain(): ?DomainInterface;

    public function getTerminalModel(): ?TerminalModelInterface;

    public function isInitialized(): bool;

    public function setPsEndpoint(PsEndpointInterface $psEndpoint): static;

    public function getPsEndpoint(): ?PsEndpointInterface;

    public function setPsIdentify(PsIdentifyInterface $psIdentify): static;

    public function getPsIdentify(): ?PsIdentifyInterface;

    public function addUser(UserInterface $user): TerminalInterface;

    public function removeUser(UserInterface $user): TerminalInterface;

    public function replaceUsers(ArrayCollection $users): TerminalInterface;

    public function getUsers(?Criteria $criteria = null): array;
}
