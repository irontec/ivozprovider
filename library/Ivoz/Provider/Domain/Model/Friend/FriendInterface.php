<?php

namespace Ivoz\Provider\Domain\Model\Friend;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Doctrine\Common\Collections\Collection;

interface FriendInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * {@inheritDoc}
     * @see FriendAbstract::setName
     */
    public function setName($name);

    /**
     * {@inheritDoc}
     * @see FriendAbstract::setIp
     */
    public function setIp($ip = null);

    /**
     * {@inheritDoc}
     * @see FriendAbstract::setPort
     */
    public function setPort($port = null);

    /**
     * {@inheritDoc}
     * @see FriendAbstract::setPassword
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
     * @param $exten
     * @return bool
     */
    public function checkExtension($exten);

    /**
     * @param string $exten
     * @return bool canCall
     */
    public function isAllowedToCall($exten);

    public function getAstPsEndpoint();

    public function getLanguageCode();

    /**
     * Get Friend outgoingDdi
     * If no Ddi is assigned, retrieve company's default Ddi
     *
     * @return \Ivoz\Provider\Domain\Model\Ddi\DdiInterface
     */
    public function getOutgoingDdi();

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * @deprecated
     * Set description
     *
     * @param string $description
     *
     * @return self
     */
    public function setDescription($description);

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription();

    /**
     * @deprecated
     * Set transport
     *
     * @param string $transport
     *
     * @return self
     */
    public function setTransport($transport);

    /**
     * Get transport
     *
     * @return string
     */
    public function getTransport();

    /**
     * Get ip
     *
     * @return string
     */
    public function getIp();

    /**
     * Get port
     *
     * @return integer
     */
    public function getPort();

    /**
     * @deprecated
     * Set authNeeded
     *
     * @param string $authNeeded
     *
     * @return self
     */
    public function setAuthNeeded($authNeeded);

    /**
     * Get authNeeded
     *
     * @return string
     */
    public function getAuthNeeded();

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword();

    /**
     * @deprecated
     * Set priority
     *
     * @param integer $priority
     *
     * @return self
     */
    public function setPriority($priority);

    /**
     * Get priority
     *
     * @return integer
     */
    public function getPriority();

    /**
     * @deprecated
     * Set disallow
     *
     * @param string $disallow
     *
     * @return self
     */
    public function setDisallow($disallow);

    /**
     * Get disallow
     *
     * @return string
     */
    public function getDisallow();

    /**
     * @deprecated
     * Set allow
     *
     * @param string $allow
     *
     * @return self
     */
    public function setAllow($allow);

    /**
     * Get allow
     *
     * @return string
     */
    public function getAllow();

    /**
     * @deprecated
     * Set directMediaMethod
     *
     * @param string $directMediaMethod
     *
     * @return self
     */
    public function setDirectMediaMethod($directMediaMethod);

    /**
     * Get directMediaMethod
     *
     * @return string
     */
    public function getDirectMediaMethod();

    /**
     * @deprecated
     * Set calleridUpdateHeader
     *
     * @param string $calleridUpdateHeader
     *
     * @return self
     */
    public function setCalleridUpdateHeader($calleridUpdateHeader);

    /**
     * Get calleridUpdateHeader
     *
     * @return string
     */
    public function getCalleridUpdateHeader();

    /**
     * @deprecated
     * Set updateCallerid
     *
     * @param string $updateCallerid
     *
     * @return self
     */
    public function setUpdateCallerid($updateCallerid);

    /**
     * Get updateCallerid
     *
     * @return string
     */
    public function getUpdateCallerid();

    /**
     * @deprecated
     * Set fromDomain
     *
     * @param string $fromDomain
     *
     * @return self
     */
    public function setFromDomain($fromDomain = null);

    /**
     * Get fromDomain
     *
     * @return string
     */
    public function getFromDomain();

    /**
     * @deprecated
     * Set directConnectivity
     *
     * @param string $directConnectivity
     *
     * @return self
     */
    public function setDirectConnectivity($directConnectivity);

    /**
     * Get directConnectivity
     *
     * @return string
     */
    public function getDirectConnectivity();

    /**
     * Set company
     *
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company
     *
     * @return self
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company = null);

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    public function getCompany();

    /**
     * Set domain
     *
     * @param \Ivoz\Provider\Domain\Model\Domain\DomainInterface $domain
     *
     * @return self
     */
    public function setDomain(\Ivoz\Provider\Domain\Model\Domain\DomainInterface $domain = null);

    /**
     * Get domain
     *
     * @return \Ivoz\Provider\Domain\Model\Domain\DomainInterface
     */
    public function getDomain();

    /**
     * Set transformationRuleSet
     *
     * @param \Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface $transformationRuleSet
     *
     * @return self
     */
    public function setTransformationRuleSet(\Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface $transformationRuleSet = null);

    /**
     * Get transformationRuleSet
     *
     * @return \Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface
     */
    public function getTransformationRuleSet();

    /**
     * Set callAcl
     *
     * @param \Ivoz\Provider\Domain\Model\CallAcl\CallAclInterface $callAcl
     *
     * @return self
     */
    public function setCallAcl(\Ivoz\Provider\Domain\Model\CallAcl\CallAclInterface $callAcl = null);

    /**
     * Get callAcl
     *
     * @return \Ivoz\Provider\Domain\Model\CallAcl\CallAclInterface
     */
    public function getCallAcl();

    /**
     * Set outgoingDdi
     *
     * @param \Ivoz\Provider\Domain\Model\Ddi\DdiInterface $outgoingDdi
     *
     * @return self
     */
    public function setOutgoingDdi(\Ivoz\Provider\Domain\Model\Ddi\DdiInterface $outgoingDdi = null);

    /**
     * Set language
     *
     * @param \Ivoz\Provider\Domain\Model\Language\LanguageInterface $language
     *
     * @return self
     */
    public function setLanguage(\Ivoz\Provider\Domain\Model\Language\LanguageInterface $language = null);

    /**
     * Get language
     *
     * @return \Ivoz\Provider\Domain\Model\Language\LanguageInterface
     */
    public function getLanguage();

    /**
     * Add psEndpoint
     *
     * @param \Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface $psEndpoint
     *
     * @return FriendTrait
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
     * @param \Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface[] $psEndpoints
     * @return self
     */
    public function replacePsEndpoints(Collection $psEndpoints);

    /**
     * Get psEndpoints
     *
     * @return \Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface[]
     */
    public function getPsEndpoints(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * Add pattern
     *
     * @param \Ivoz\Provider\Domain\Model\FriendsPattern\FriendsPatternInterface $pattern
     *
     * @return FriendTrait
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
     * @param \Ivoz\Provider\Domain\Model\FriendsPattern\FriendsPatternInterface[] $patterns
     * @return self
     */
    public function replacePatterns(Collection $patterns);

    /**
     * Get patterns
     *
     * @return \Ivoz\Provider\Domain\Model\FriendsPattern\FriendsPatternInterface[]
     */
    public function getPatterns(\Doctrine\Common\Collections\Criteria $criteria = null);

}

