<?php

namespace Ivoz\Ast\Domain\Model\PsEndpoint;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface PsEndpointInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * Update this user endpoint with current model data
     */
    public function updateByUser(\Ivoz\Provider\Domain\Model\User\UserInterface $user);

    /**
     * Set sorceryId
     *
     * @param string $sorceryId
     *
     * @return self
     */
    public function setSorceryId($sorceryId);

    /**
     * Get sorceryId
     *
     * @return string
     */
    public function getSorceryId();

    /**
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
     * Set aors
     *
     * @param string $aors
     *
     * @return self
     */
    public function setAors($aors = null);

    /**
     * Get aors
     *
     * @return string
     */
    public function getAors();

    /**
     * Set callerid
     *
     * @param string $callerid
     *
     * @return self
     */
    public function setCallerid($callerid = null);

    /**
     * Get callerid
     *
     * @return string
     */
    public function getCallerid();

    /**
     * Set context
     *
     * @param string $context
     *
     * @return self
     */
    public function setContext($context);

    /**
     * Get context
     *
     * @return string
     */
    public function getContext();

    /**
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
     * Set directMedia
     *
     * @param string $directMedia
     *
     * @return self
     */
    public function setDirectMedia($directMedia = null);

    /**
     * Get directMedia
     *
     * @return string
     */
    public function getDirectMedia();

    /**
     * Set directMediaMethod
     *
     * @param string $directMediaMethod
     *
     * @return self
     */
    public function setDirectMediaMethod($directMediaMethod = null);

    /**
     * Get directMediaMethod
     *
     * @return string
     */
    public function getDirectMediaMethod();

    /**
     * Set mailboxes
     *
     * @param string $mailboxes
     *
     * @return self
     */
    public function setMailboxes($mailboxes = null);

    /**
     * Get mailboxes
     *
     * @return string
     */
    public function getMailboxes();

    /**
     * Set namedPickupGroup
     *
     * @param string $namedPickupGroup
     *
     * @return self
     */
    public function setNamedPickupGroup($namedPickupGroup = null);

    /**
     * Get namedPickupGroup
     *
     * @return string
     */
    public function getNamedPickupGroup();

    /**
     * Set sendDiversion
     *
     * @param string $sendDiversion
     *
     * @return self
     */
    public function setSendDiversion($sendDiversion = null);

    /**
     * Get sendDiversion
     *
     * @return string
     */
    public function getSendDiversion();

    /**
     * Set sendPai
     *
     * @param string $sendPai
     *
     * @return self
     */
    public function setSendPai($sendPai = null);

    /**
     * Get sendPai
     *
     * @return string
     */
    public function getSendPai();

    /**
     * Set oneHundredRel
     *
     * @param string $oneHundredRel
     *
     * @return self
     */
    public function setOneHundredRel($oneHundredRel);

    /**
     * Get oneHundredRel
     *
     * @return string
     */
    public function getOneHundredRel();

    /**
     * Set outboundProxy
     *
     * @param string $outboundProxy
     *
     * @return self
     */
    public function setOutboundProxy($outboundProxy = null);

    /**
     * Get outboundProxy
     *
     * @return string
     */
    public function getOutboundProxy();

    /**
     * Set trustIdInbound
     *
     * @param string $trustIdInbound
     *
     * @return self
     */
    public function setTrustIdInbound($trustIdInbound = null);

    /**
     * Get trustIdInbound
     *
     * @return string
     */
    public function getTrustIdInbound();

    /**
     * Set terminal
     *
     * @param \Ivoz\Provider\Domain\Model\Terminal\TerminalInterface $terminal
     *
     * @return self
     */
    public function setTerminal(\Ivoz\Provider\Domain\Model\Terminal\TerminalInterface $terminal = null);

    /**
     * Get terminal
     *
     * @return \Ivoz\Provider\Domain\Model\Terminal\TerminalInterface
     */
    public function getTerminal();

    /**
     * Set friend
     *
     * @param \Ivoz\Provider\Domain\Model\Friend\FriendInterface $friend
     *
     * @return self
     */
    public function setFriend(\Ivoz\Provider\Domain\Model\Friend\FriendInterface $friend = null);

    /**
     * Get friend
     *
     * @return \Ivoz\Provider\Domain\Model\Friend\FriendInterface
     */
    public function getFriend();

    /**
     * Set retailAccount
     *
     * @param \Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface $retailAccount
     *
     * @return self
     */
    public function setRetailAccount(\Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface $retailAccount = null);

    /**
     * Get retailAccount
     *
     * @return \Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface
     */
    public function getRetailAccount();

}

