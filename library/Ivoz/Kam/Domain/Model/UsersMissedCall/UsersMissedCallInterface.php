<?php

namespace Ivoz\Kam\Domain\Model\UsersMissedCall;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface UsersMissedCallInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * Set method
     *
     * @param string $method
     *
     * @return self
     */
    public function setMethod($method);

    /**
     * Get method
     *
     * @return string
     */
    public function getMethod();

    /**
     * Set fromTag
     *
     * @param string $fromTag
     *
     * @return self
     */
    public function setFromTag($fromTag);

    /**
     * Get fromTag
     *
     * @return string
     */
    public function getFromTag();

    /**
     * Set toTag
     *
     * @param string $toTag
     *
     * @return self
     */
    public function setToTag($toTag);

    /**
     * Get toTag
     *
     * @return string
     */
    public function getToTag();

    /**
     * Set callid
     *
     * @param string $callid
     *
     * @return self
     */
    public function setCallid($callid);

    /**
     * Get callid
     *
     * @return string
     */
    public function getCallid();

    /**
     * Set sipCode
     *
     * @param string $sipCode
     *
     * @return self
     */
    public function setSipCode($sipCode);

    /**
     * Get sipCode
     *
     * @return string
     */
    public function getSipCode();

    /**
     * Set sipReason
     *
     * @param string $sipReason
     *
     * @return self
     */
    public function setSipReason($sipReason);

    /**
     * Get sipReason
     *
     * @return string
     */
    public function getSipReason();

    /**
     * Set srcIp
     *
     * @param string $srcIp
     *
     * @return self
     */
    public function setSrcIp($srcIp = null);

    /**
     * Get srcIp
     *
     * @return string
     */
    public function getSrcIp();

    /**
     * Set fromUser
     *
     * @param string $fromUser
     *
     * @return self
     */
    public function setFromUser($fromUser = null);

    /**
     * Get fromUser
     *
     * @return string
     */
    public function getFromUser();

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
     * Set ruriUser
     *
     * @param string $ruriUser
     *
     * @return self
     */
    public function setRuriUser($ruriUser = null);

    /**
     * Get ruriUser
     *
     * @return string
     */
    public function getRuriUser();

    /**
     * Set ruriDomain
     *
     * @param string $ruriDomain
     *
     * @return self
     */
    public function setRuriDomain($ruriDomain = null);

    /**
     * Get ruriDomain
     *
     * @return string
     */
    public function getRuriDomain();

    /**
     * Set cseq
     *
     * @param integer $cseq
     *
     * @return self
     */
    public function setCseq($cseq = null);

    /**
     * Get cseq
     *
     * @return integer
     */
    public function getCseq();

    /**
     * Set localtime
     *
     * @param \DateTime $localtime
     *
     * @return self
     */
    public function setLocaltime($localtime);

    /**
     * Get localtime
     *
     * @return \DateTime
     */
    public function getLocaltime();

    /**
     * Set utctime
     *
     * @param string $utctime
     *
     * @return self
     */
    public function setUtctime($utctime = null);

    /**
     * Get utctime
     *
     * @return string
     */
    public function getUtctime();

}

