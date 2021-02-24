<?php

namespace Ivoz\Provider\Domain\Model\Friend;

use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Domain\DomainInterface;
use Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface;
use Ivoz\Provider\Domain\Model\CallAcl\CallAclInterface;
use Ivoz\Provider\Domain\Model\Language\LanguageInterface;
use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\FriendsPattern\FriendsPatternInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* FriendInterface
*/
interface FriendInterface extends LoggableEntityInterface
{
    const TRANSPORT_UDP = 'udp';

    const TRANSPORT_TCP = 'tcp';

    const TRANSPORT_TLS = 'tls';

    const DIRECTMEDIAMETHOD_INVITE = 'invite';

    const DIRECTMEDIAMETHOD_UPDATE = 'update';

    const CALLERIDUPDATEHEADER_PAI = 'pai';

    const CALLERIDUPDATEHEADER_RPID = 'rpid';

    const UPDATECALLERID_YES = 'yes';

    const UPDATECALLERID_NO = 'no';

    const DIRECTCONNECTIVITY_YES = 'yes';

    const DIRECTCONNECTIVITY_NO = 'no';

    const DIRECTCONNECTIVITY_INTERVPBX = 'intervpbx';

    const DDIIN_YES = 'yes';

    const DDIIN_NO = 'no';

    const T38PASSTHROUGH_YES = 'yes';

    const T38PASSTHROUGH_NO = 'no';

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * @return bool
     */
    public function isInterPbxConnectivity(): bool;

    /**
     * @return bool
     */
    public function isDirectConnectivity(): bool;

    /**
     * @return bool
     */
    public function isRegisterConnectivity(): bool;

    /**
     * @param string $number
     * @return \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface | null
     */
    public function getInterCompanyExtension($number);

    /**
     * {@inheritDoc}
     * @see FriendAbstract::setIp
     * @deprecated this method will be protected
     */
    public function setIp(string $ip = null): FriendInterface;

    /**
     * {@inheritDoc}
     * @see FriendAbstract::setPort
     * @deprecated this method will be protected
     */
    public function setPort(int $port = null): FriendInterface;

    /**
     * {@inheritDoc}
     * @see FriendAbstract::setPassword
     * @deprecated this method will be protected
     */
    public function setPassword(string $password = null): FriendInterface;

    /**
     * @return string
     */
    public function getContact();

    /**
     * @return string
     */
    public function getSorcery();

    /**
     * @param string $exten
     * @return bool
     */
    public function checkExtension($exten);

    /**
     * @param string $exten
     * @return bool canCall
     */
    public function isAllowedToCall($exten);

    /**
     * @return \Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface|mixed
     */
    public function getAstPsEndpoint();

    public function getLanguageCode();

    /**
     * Get Friend outgoingDdi
     * If no Ddi is assigned, retrieve company's default Ddi
     *
     * @return \Ivoz\Provider\Domain\Model\Ddi\DdiInterface|null
     */
    public function getOutgoingDdi(): ?DdiInterface;

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription(): string;

    /**
     * Get transport
     *
     * @return string | null
     */
    public function getTransport(): ?string;

    /**
     * Get ip
     *
     * @return string | null
     */
    public function getIp(): ?string;

    /**
     * Get port
     *
     * @return int | null
     */
    public function getPort(): ?int;

    /**
     * Get password
     *
     * @return string | null
     */
    public function getPassword(): ?string;

    /**
     * Get priority
     *
     * @return int
     */
    public function getPriority(): int;

    /**
     * Get disallow
     *
     * @return string
     */
    public function getDisallow(): string;

    /**
     * Get allow
     *
     * @return string
     */
    public function getAllow(): string;

    /**
     * Get directMediaMethod
     *
     * @return string
     */
    public function getDirectMediaMethod(): string;

    /**
     * Get calleridUpdateHeader
     *
     * @return string
     */
    public function getCalleridUpdateHeader(): string;

    /**
     * Get updateCallerid
     *
     * @return string
     */
    public function getUpdateCallerid(): string;

    /**
     * Get fromUser
     *
     * @return string | null
     */
    public function getFromUser(): ?string;

    /**
     * Get fromDomain
     *
     * @return string | null
     */
    public function getFromDomain(): ?string;

    /**
     * Get directConnectivity
     *
     * @return string
     */
    public function getDirectConnectivity(): string;

    /**
     * Get ddiIn
     *
     * @return string
     */
    public function getDdiIn(): string;

    /**
     * Get t38Passthrough
     *
     * @return string
     */
    public function getT38Passthrough(): string;

    /**
     * Get alwaysApplyTransformations
     *
     * @return bool
     */
    public function getAlwaysApplyTransformations(): bool;

    /**
     * Get rtpEncryption
     *
     * @return bool
     */
    public function getRtpEncryption(): bool;

    /**
     * Get multiContact
     *
     * @return boolean
     */
    public function getMultiContact(): bool;

    /**
     * Set company
     *
     * @param CompanyInterface
     *
     * @return static
     */
    public function setCompany(CompanyInterface $company): FriendInterface;

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
    public function setDomain(?DomainInterface $domain = null): FriendInterface;

    /**
     * Get domain
     *
     * @return DomainInterface | null
     */
    public function getDomain(): ?DomainInterface;

    /**
     * Get transformationRuleSet
     *
     * @return TransformationRuleSetInterface | null
     */
    public function getTransformationRuleSet(): ?TransformationRuleSetInterface;

    /**
     * Get callAcl
     *
     * @return CallAclInterface | null
     */
    public function getCallAcl(): ?CallAclInterface;

    /**
     * Get language
     *
     * @return LanguageInterface | null
     */
    public function getLanguage(): ?LanguageInterface;

    /**
     * Get interCompany
     *
     * @return CompanyInterface | null
     */
    public function getInterCompany(): ?CompanyInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

    /**
     * Add psEndpoint
     *
     * @param PsEndpointInterface $psEndpoint
     *
     * @return static
     */
    public function addPsEndpoint(PsEndpointInterface $psEndpoint): FriendInterface;

    /**
     * Remove psEndpoint
     *
     * @param PsEndpointInterface $psEndpoint
     *
     * @return static
     */
    public function removePsEndpoint(PsEndpointInterface $psEndpoint): FriendInterface;

    /**
     * Replace psEndpoints
     *
     * @param ArrayCollection $psEndpoints of PsEndpointInterface
     *
     * @return static
     */
    public function replacePsEndpoints(ArrayCollection $psEndpoints): FriendInterface;

    /**
     * Get psEndpoints
     * @param Criteria | null $criteria
     * @return PsEndpointInterface[]
     */
    public function getPsEndpoints(?Criteria $criteria = null): array;

    /**
     * Add pattern
     *
     * @param FriendsPatternInterface $pattern
     *
     * @return static
     */
    public function addPattern(FriendsPatternInterface $pattern): FriendInterface;

    /**
     * Remove pattern
     *
     * @param FriendsPatternInterface $pattern
     *
     * @return static
     */
    public function removePattern(FriendsPatternInterface $pattern): FriendInterface;

    /**
     * Replace patterns
     *
     * @param ArrayCollection $patterns of FriendsPatternInterface
     *
     * @return static
     */
    public function replacePatterns(ArrayCollection $patterns): FriendInterface;

    /**
     * Get patterns
     * @param Criteria | null $criteria
     * @return FriendsPatternInterface[]
     */
    public function getPatterns(?Criteria $criteria = null): array;

}
