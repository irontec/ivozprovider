<?php

namespace Ivoz\Kam\Domain\Model\UsersMissedCall;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;

/**
 * @codeCoverageIgnore
 */
class UsersMissedCallDTO implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $method = '';

    /**
     * @var string
     */
    private $fromTag = '';

    /**
     * @var string
     */
    private $toTag = '';

    /**
     * @var string
     */
    private $callid = '';

    /**
     * @var string
     */
    private $sipCode = '';

    /**
     * @var string
     */
    private $sipReason = '';

    /**
     * @var string
     */
    private $srcIp;

    /**
     * @var string
     */
    private $fromUser;

    /**
     * @var string
     */
    private $fromDomain;

    /**
     * @var string
     */
    private $ruriUser;

    /**
     * @var string
     */
    private $ruriDomain;

    /**
     * @var integer
     */
    private $cseq;

    /**
     * @var \DateTime
     */
    private $localtime;

    /**
     * @var string
     */
    private $utctime;

    /**
     * @var integer
     */
    private $id;

    /**
     * @return array
     */
    public function __toArray()
    {
        return [
            'method' => $this->getMethod(),
            'fromTag' => $this->getFromTag(),
            'toTag' => $this->getToTag(),
            'callid' => $this->getCallid(),
            'sipCode' => $this->getSipCode(),
            'sipReason' => $this->getSipReason(),
            'srcIp' => $this->getSrcIp(),
            'fromUser' => $this->getFromUser(),
            'fromDomain' => $this->getFromDomain(),
            'ruriUser' => $this->getRuriUser(),
            'ruriDomain' => $this->getRuriDomain(),
            'cseq' => $this->getCseq(),
            'localtime' => $this->getLocaltime(),
            'utctime' => $this->getUtctime(),
            'id' => $this->getId()
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function transformForeignKeys(ForeignKeyTransformerInterface $transformer)
    {

    }

    /**
     * {@inheritDoc}
     */
    public function transformCollections(CollectionTransformerInterface $transformer)
    {

    }

    /**
     * @param string $method
     *
     * @return UsersMissedCallDTO
     */
    public function setMethod($method)
    {
        $this->method = $method;

        return $this;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param string $fromTag
     *
     * @return UsersMissedCallDTO
     */
    public function setFromTag($fromTag)
    {
        $this->fromTag = $fromTag;

        return $this;
    }

    /**
     * @return string
     */
    public function getFromTag()
    {
        return $this->fromTag;
    }

    /**
     * @param string $toTag
     *
     * @return UsersMissedCallDTO
     */
    public function setToTag($toTag)
    {
        $this->toTag = $toTag;

        return $this;
    }

    /**
     * @return string
     */
    public function getToTag()
    {
        return $this->toTag;
    }

    /**
     * @param string $callid
     *
     * @return UsersMissedCallDTO
     */
    public function setCallid($callid)
    {
        $this->callid = $callid;

        return $this;
    }

    /**
     * @return string
     */
    public function getCallid()
    {
        return $this->callid;
    }

    /**
     * @param string $sipCode
     *
     * @return UsersMissedCallDTO
     */
    public function setSipCode($sipCode)
    {
        $this->sipCode = $sipCode;

        return $this;
    }

    /**
     * @return string
     */
    public function getSipCode()
    {
        return $this->sipCode;
    }

    /**
     * @param string $sipReason
     *
     * @return UsersMissedCallDTO
     */
    public function setSipReason($sipReason)
    {
        $this->sipReason = $sipReason;

        return $this;
    }

    /**
     * @return string
     */
    public function getSipReason()
    {
        return $this->sipReason;
    }

    /**
     * @param string $srcIp
     *
     * @return UsersMissedCallDTO
     */
    public function setSrcIp($srcIp = null)
    {
        $this->srcIp = $srcIp;

        return $this;
    }

    /**
     * @return string
     */
    public function getSrcIp()
    {
        return $this->srcIp;
    }

    /**
     * @param string $fromUser
     *
     * @return UsersMissedCallDTO
     */
    public function setFromUser($fromUser = null)
    {
        $this->fromUser = $fromUser;

        return $this;
    }

    /**
     * @return string
     */
    public function getFromUser()
    {
        return $this->fromUser;
    }

    /**
     * @param string $fromDomain
     *
     * @return UsersMissedCallDTO
     */
    public function setFromDomain($fromDomain = null)
    {
        $this->fromDomain = $fromDomain;

        return $this;
    }

    /**
     * @return string
     */
    public function getFromDomain()
    {
        return $this->fromDomain;
    }

    /**
     * @param string $ruriUser
     *
     * @return UsersMissedCallDTO
     */
    public function setRuriUser($ruriUser = null)
    {
        $this->ruriUser = $ruriUser;

        return $this;
    }

    /**
     * @return string
     */
    public function getRuriUser()
    {
        return $this->ruriUser;
    }

    /**
     * @param string $ruriDomain
     *
     * @return UsersMissedCallDTO
     */
    public function setRuriDomain($ruriDomain = null)
    {
        $this->ruriDomain = $ruriDomain;

        return $this;
    }

    /**
     * @return string
     */
    public function getRuriDomain()
    {
        return $this->ruriDomain;
    }

    /**
     * @param integer $cseq
     *
     * @return UsersMissedCallDTO
     */
    public function setCseq($cseq = null)
    {
        $this->cseq = $cseq;

        return $this;
    }

    /**
     * @return integer
     */
    public function getCseq()
    {
        return $this->cseq;
    }

    /**
     * @param \DateTime $localtime
     *
     * @return UsersMissedCallDTO
     */
    public function setLocaltime($localtime)
    {
        $this->localtime = $localtime;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getLocaltime()
    {
        return $this->localtime;
    }

    /**
     * @param string $utctime
     *
     * @return UsersMissedCallDTO
     */
    public function setUtctime($utctime = null)
    {
        $this->utctime = $utctime;

        return $this;
    }

    /**
     * @return string
     */
    public function getUtctime()
    {
        return $this->utctime;
    }

    /**
     * @param integer $id
     *
     * @return UsersMissedCallDTO
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}


