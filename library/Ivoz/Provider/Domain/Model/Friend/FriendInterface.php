<?php

namespace Ivoz\Provider\Domain\Model\Friend;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
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
    public function setIp(?string $ip = null): static;

    /**
     * {@inheritDoc}
     * @see FriendAbstract::setPort
     * @deprecated this method will be protected
     */
    public function setPort(?int $port = null): static;

    /**
     * {@inheritDoc}
     * @see FriendAbstract::setPassword
     * @deprecated this method will be protected
     */
    public function setPassword(?string $password = null): static;

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

    public function getName(): string;

    public function getDescription(): string;

    public function getTransport(): ?string;

    public function getIp(): ?string;

    public function getPort(): ?int;

    public function getPassword(): ?string;

    public function getPriority(): int;

    public function getDisallow(): string;

    public function getAllow(): string;

    public function getDirectMediaMethod(): string;

    public function getCalleridUpdateHeader(): string;

    public function getUpdateCallerid(): string;

    public function getFromUser(): ?string;

    public function getFromDomain(): ?string;

    public function getDirectConnectivity(): string;

    public function getDdiIn(): string;

    public function getT38Passthrough(): string;

    public function getAlwaysApplyTransformations(): bool;

    public function getRtpEncryption(): bool;

    public function getMultiContact(): bool;

    public function setCompany(CompanyInterface $company): static;

    public function getCompany(): CompanyInterface;

    public function setDomain(?DomainInterface $domain = null): static;

    public function getDomain(): ?DomainInterface;

    public function getTransformationRuleSet(): ?TransformationRuleSetInterface;

    public function getCallAcl(): ?CallAclInterface;

    public function getLanguage(): ?LanguageInterface;

    public function getInterCompany(): ?CompanyInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

    public function addPsEndpoint(PsEndpointInterface $psEndpoint): FriendInterface;

    public function removePsEndpoint(PsEndpointInterface $psEndpoint): FriendInterface;

    public function replacePsEndpoints(ArrayCollection $psEndpoints): FriendInterface;

    public function getPsEndpoints(?Criteria $criteria = null): array;

    public function addPattern(FriendsPatternInterface $pattern): FriendInterface;

    public function removePattern(FriendsPatternInterface $pattern): FriendInterface;

    public function replacePatterns(ArrayCollection $patterns): FriendInterface;

    public function getPatterns(?Criteria $criteria = null): array;

}
