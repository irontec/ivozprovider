<?php

namespace Ivoz\Provider\Domain\Model\Friend;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\ArrayCollection;

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
     * @param string $number
     * @return \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface | null
     */
    public function getInterCompanyExtension($number);

    /**
     * {@inheritDoc}
     * @see FriendAbstract::setIp
     * @deprecated this method will be protected
     */
    public function setIp($ip = null);

    /**
     * {@inheritDoc}
     * @see FriendAbstract::setPort
     * @deprecated this method will be protected
     */
    public function setPort($port = null);

    /**
     * {@inheritDoc}
     * @see FriendAbstract::setPassword
     * @deprecated this method will be protected
     */
    public function setPassword($password = null);

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
    public function getOutgoingDdi();

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
    public function getTransport();

    /**
     * Get ip
     *
     * @return string | null
     */
    public function getIp();

    /**
     * Get port
     *
     * @return integer | null
     */
    public function getPort();

    /**
     * Get authNeeded
     *
     * @return string
     */
    public function getAuthNeeded(): string;

    /**
     * Get password
     *
     * @return string | null
     */
    public function getPassword();

    /**
     * Get priority
     *
     * @return integer
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
     * Get fromDomain
     *
     * @return string | null
     */
    public function getFromDomain();

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
     * Set company
     *
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company
     *
     * @return static
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company);

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    public function getCompany();

    /**
     * Set domain
     *
     * @param \Ivoz\Provider\Domain\Model\Domain\DomainInterface $domain | null
     *
     * @return static
     */
    public function setDomain(\Ivoz\Provider\Domain\Model\Domain\DomainInterface $domain = null);

    /**
     * Get domain
     *
     * @return \Ivoz\Provider\Domain\Model\Domain\DomainInterface | null
     */
    public function getDomain();

    /**
     * Get transformationRuleSet
     *
     * @return \Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface | null
     */
    public function getTransformationRuleSet();

    /**
     * Get callAcl
     *
     * @return \Ivoz\Provider\Domain\Model\CallAcl\CallAclInterface | null
     */
    public function getCallAcl();

    /**
     * Get language
     *
     * @return \Ivoz\Provider\Domain\Model\Language\LanguageInterface | null
     */
    public function getLanguage();

    /**
     * Get interCompany
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface | null
     */
    public function getInterCompany();

    /**
     * @return bool
     */
    public function isInitialized(): bool;

    /**
     * Add psEndpoint
     *
     * @param \Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface $psEndpoint
     *
     * @return static
     */
    public function addPsEndpoint(\Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface $psEndpoint);

    /**
     * Remove psEndpoint
     *
     * @param \Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface $psEndpoint
     */
    public function removePsEndpoint(\Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface $psEndpoint);

    /**
     * Replace psEndpoints
     *
     * @param ArrayCollection $psEndpoints of Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface
     * @return static
     */
    public function replacePsEndpoints(ArrayCollection $psEndpoints);

    /**
     * Get psEndpoints
     * @param Criteria | null $criteria
     * @return \Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface[]
     */
    public function getPsEndpoints(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * Add pattern
     *
     * @param \Ivoz\Provider\Domain\Model\FriendsPattern\FriendsPatternInterface $pattern
     *
     * @return static
     */
    public function addPattern(\Ivoz\Provider\Domain\Model\FriendsPattern\FriendsPatternInterface $pattern);

    /**
     * Remove pattern
     *
     * @param \Ivoz\Provider\Domain\Model\FriendsPattern\FriendsPatternInterface $pattern
     */
    public function removePattern(\Ivoz\Provider\Domain\Model\FriendsPattern\FriendsPatternInterface $pattern);

    /**
     * Replace patterns
     *
     * @param ArrayCollection $patterns of Ivoz\Provider\Domain\Model\FriendsPattern\FriendsPatternInterface
     * @return static
     */
    public function replacePatterns(ArrayCollection $patterns);

    /**
     * Get patterns
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\FriendsPattern\FriendsPatternInterface[]
     */
    public function getPatterns(\Doctrine\Common\Collections\Criteria $criteria = null);
}
