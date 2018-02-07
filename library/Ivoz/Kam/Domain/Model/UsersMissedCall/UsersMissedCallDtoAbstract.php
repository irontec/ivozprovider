<?php

namespace Ivoz\Kam\Domain\Model\UsersMissedCall;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class UsersMissedCallDtoAbstract implements DataTransferObjectInterface
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


    use DtoNormalizer;

    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
     * @inheritdoc
     */
    public static function getPropertyMap(string $context = '')
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return ['id' => 'id'];
        }

        return [
            'method' => 'method',
            'fromTag' => 'fromTag',
            'toTag' => 'toTag',
            'callid' => 'callid',
            'sipCode' => 'sipCode',
            'sipReason' => 'sipReason',
            'srcIp' => 'srcIp',
            'fromUser' => 'fromUser',
            'fromDomain' => 'fromDomain',
            'ruriUser' => 'ruriUser',
            'ruriDomain' => 'ruriDomain',
            'cseq' => 'cseq',
            'localtime' => 'localtime',
            'utctime' => 'utctime',
            'id' => 'id'
        ];
    }

    /**
     * @return array
     */
    public function toArray($hideSensitiveData = false)
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
     * @return static
     */
    public function setMethod($method = null)
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
     * @return static
     */
    public function setFromTag($fromTag = null)
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
     * @return static
     */
    public function setToTag($toTag = null)
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
     * @return static
     */
    public function setCallid($callid = null)
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
     * @return static
     */
    public function setSipCode($sipCode = null)
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
     * @return static
     */
    public function setSipReason($sipReason = null)
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
     * @return static
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
     * @return static
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
     * @return static
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
     * @return static
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
     * @return static
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
     * @return static
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
     * @return static
     */
    public function setLocaltime($localtime = null)
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
     * @return static
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
     * @return static
     */
    public function setId($id = null)
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


