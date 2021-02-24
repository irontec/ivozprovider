<?php

namespace Ivoz\Provider\Domain\Model\Terminal;

use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Domain\DomainInterface;
use Ivoz\Provider\Domain\Model\TerminalModel\TerminalModelInterface;
use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* TerminalInterface
*/
interface TerminalInterface extends LoggableEntityInterface
{
    const DIRECTMEDIAMETHOD_UPDATE = 'update';

    const DIRECTMEDIAMETHOD_INVITE = 'invite';

    const DIRECTMEDIAMETHOD_REINVITE = 'reinvite';

    const T38PASSTHROUGH_YES = 'yes';

    const T38PASSTHROUGH_NO = 'no';

    /**
     * @return array
     */
    public function getChangeSet();

    /**
     * {@inheritDoc}
     * @throws \InvalidArgumentException
     */
    public function setName(string $name = null): TerminalInterface;

    /**
     * {@inheritDoc}
     * @throws \InvalidArgumentException
     */
    public function setPassword(string $password): TerminalInterface;

    public static function randomPassword();

    public function getUser();

    /**
     * @return string
     */
    public function getContact();

    /**
     * @return string
     */
    public function getSorcery();

    /**
     * @return string
     */
    public function getAllow();

    /**
     * @return \Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface | null
     */
    public function getAstPsEndpoint();

    public function setMac(string $mac = null): TerminalInterface;

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): ?string;

    /**
     * Get disallow
     *
     * @return string
     */
    public function getDisallow(): string;

    /**
     * Get allowAudio
     *
     * @return string
     */
    public function getAllowAudio(): string;

    /**
     * Get allowVideo
     *
     * @return string | null
     */
    public function getAllowVideo(): ?string;

    /**
     * Get directMediaMethod
     *
     * @return string
     */
    public function getDirectMediaMethod(): string;

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword(): string;

    /**
     * Get mac
     *
     * @return string | null
     */
    public function getMac(): ?string;

    /**
     * Get lastProvisionDate
     *
     * @return \DateTimeInterface | null
     */
    public function getLastProvisionDate(): ?\DateTimeInterface;

    /**
     * Get t38Passthrough
     *
     * @return string
     */
    public function getT38Passthrough(): string;

    /**
     * Get rtpEncryption
     *
     * @return bool
     */
    public function getRtpEncryption(): bool;

    /**
     * Set company
     *
     * @param CompanyInterface
     *
     * @return static
     */
    public function setCompany(CompanyInterface $company): TerminalInterface;

    /**
     * Get company
     *
     * @return CompanyInterface
     */
    public function getCompany(): CompanyInterface;

    /**
     * Set domain
     *
     * @param DomainInterface | null
     *
     * @return static
     */
    public function setDomain(?DomainInterface $domain = null): TerminalInterface;

    /**
     * Get domain
     *
     * @return DomainInterface | null
     */
    public function getDomain(): ?DomainInterface;

    /**
     * Get terminalModel
     *
     * @return TerminalModelInterface | null
     */
    public function getTerminalModel(): ?TerminalModelInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

    /**
     * Add astPsEndpoint
     *
     * @param PsEndpointInterface $astPsEndpoint
     *
     * @return static
     */
    public function addAstPsEndpoint(PsEndpointInterface $astPsEndpoint): TerminalInterface;

    /**
     * Remove astPsEndpoint
     *
     * @param PsEndpointInterface $astPsEndpoint
     *
     * @return static
     */
    public function removeAstPsEndpoint(PsEndpointInterface $astPsEndpoint): TerminalInterface;

    /**
     * Replace astPsEndpoints
     *
     * @param ArrayCollection $astPsEndpoints of PsEndpointInterface
     *
     * @return static
     */
    public function replaceAstPsEndpoints(ArrayCollection $astPsEndpoints): TerminalInterface;

    /**
     * Get astPsEndpoints
     * @param Criteria | null $criteria
     * @return PsEndpointInterface[]
     */
    public function getAstPsEndpoints(?Criteria $criteria = null): array;

    /**
     * Add user
     *
     * @param UserInterface $user
     *
     * @return static
     */
    public function addUser(UserInterface $user): TerminalInterface;

    /**
     * Remove user
     *
     * @param UserInterface $user
     *
     * @return static
     */
    public function removeUser(UserInterface $user): TerminalInterface;

    /**
     * Replace users
     *
     * @param ArrayCollection $users of UserInterface
     *
     * @return static
     */
    public function replaceUsers(ArrayCollection $users): TerminalInterface;

    /**
     * Get users
     * @param Criteria | null $criteria
     * @return UserInterface[]
     */
    public function getUsers(?Criteria $criteria = null): array;

}
