<?php

namespace Ivoz\Kam\Domain\Model\UsersMissedCall;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;

/**
 * UsersMissedCallAbstract
 * @codeCoverageIgnore
 */
abstract class UsersMissedCallAbstract
{
    /**
     * @var string
     */
    protected $method = '';

    /**
     * @column from_tag
     * @var string
     */
    protected $fromTag = '';

    /**
     * @column to_tag
     * @var string
     */
    protected $toTag = '';

    /**
     * @var string
     */
    protected $callid = '';

    /**
     * @column sip_code
     * @var string
     */
    protected $sipCode = '';

    /**
     * @column sip_reason
     * @var string
     */
    protected $sipReason = '';

    /**
     * @column src_ip
     * @var string
     */
    protected $srcIp;

    /**
     * @column from_user
     * @var string
     */
    protected $fromUser;

    /**
     * @column from_domain
     * @var string
     */
    protected $fromDomain;

    /**
     * @column ruri_user
     * @var string
     */
    protected $ruriUser;

    /**
     * @column ruri_domain
     * @var string
     */
    protected $ruriDomain;

    /**
     * @var integer
     */
    protected $cseq;

    /**
     * @var \DateTime
     */
    protected $localtime;

    /**
     * @var string
     */
    protected $utctime;


    /**
     * Changelog tracking purpose
     * @var array
     */
    protected $_initialValues = [];

    /**
     * Constructor
     */
    public function __construct(
        $method,
        $fromTag,
        $toTag,
        $callid,
        $sipCode,
        $sipReason,
        $localtime
    ) {
        $this->setMethod($method);
        $this->setFromTag($fromTag);
        $this->setToTag($toTag);
        $this->setCallid($callid);
        $this->setSipCode($sipCode);
        $this->setSipReason($sipReason);
        $this->setLocaltime($localtime);

        $this->initChangelog();
    }

    /**
     * @param string $fieldName
     * @return mixed
     * @throws \Exception
     */
    public function initChangelog()
    {
        $values = $this->__toArray();
        if (!$this->getId()) {
            // Empty values for entities with no Id
            foreach ($values as $key => $val) {
                $values[$key] = null;
            }
        }

        $this->_initialValues = $values;
    }

    /**
     * @param string $fieldName
     * @return mixed
     * @throws \Exception
     */
    public function hasChanged($dbFieldName)
    {
        if (!array_key_exists($dbFieldName, $this->_initialValues)) {
            throw new \Exception($dbFieldName . ' field was not found');
        }
        $currentValues = $this->__toArray();

        return $currentValues[$dbFieldName] != $this->_initialValues[$dbFieldName];
    }

    public function getInitialValue($dbFieldName)
    {
        if (!array_key_exists($dbFieldName, $this->_initialValues)) {
            throw new \Exception($dbFieldName . ' field was not found');
        }

        return $this->_initialValues[$dbFieldName];
    }

    /**
     * @return array
     */
    protected function getChangeSet()
    {
        $changes = [];
        $currentValues = $this->__toArray();
        foreach ($currentValues as $key => $value) {

            if ($this->_initialValues[$key] == $currentValues[$key]) {
                continue;
            }

            $value = $currentValues[$key];
            if ($value instanceof \DateTime) {
                $value = $value->format('Y-m-d H:i:s');
            }

            $changes[$key] = $value;
        }

        return $changes;
    }

    /**
     * @return UsersMissedCallDTO
     */
    public static function createDTO()
    {
        return new UsersMissedCallDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto UsersMissedCallDTO
         */
        Assertion::isInstanceOf($dto, UsersMissedCallDTO::class);

        $self = new static(
            $dto->getMethod(),
            $dto->getFromTag(),
            $dto->getToTag(),
            $dto->getCallid(),
            $dto->getSipCode(),
            $dto->getSipReason(),
            $dto->getLocaltime());

        return $self
            ->setSrcIp($dto->getSrcIp())
            ->setFromUser($dto->getFromUser())
            ->setFromDomain($dto->getFromDomain())
            ->setRuriUser($dto->getRuriUser())
            ->setRuriDomain($dto->getRuriDomain())
            ->setCseq($dto->getCseq())
            ->setUtctime($dto->getUtctime())
        ;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto UsersMissedCallDTO
         */
        Assertion::isInstanceOf($dto, UsersMissedCallDTO::class);

        $this
            ->setMethod($dto->getMethod())
            ->setFromTag($dto->getFromTag())
            ->setToTag($dto->getToTag())
            ->setCallid($dto->getCallid())
            ->setSipCode($dto->getSipCode())
            ->setSipReason($dto->getSipReason())
            ->setSrcIp($dto->getSrcIp())
            ->setFromUser($dto->getFromUser())
            ->setFromDomain($dto->getFromDomain())
            ->setRuriUser($dto->getRuriUser())
            ->setRuriDomain($dto->getRuriDomain())
            ->setCseq($dto->getCseq())
            ->setLocaltime($dto->getLocaltime())
            ->setUtctime($dto->getUtctime());


        return $this;
    }

    /**
     * @return UsersMissedCallDTO
     */
    public function toDTO()
    {
        return self::createDTO()
            ->setMethod($this->getMethod())
            ->setFromTag($this->getFromTag())
            ->setToTag($this->getToTag())
            ->setCallid($this->getCallid())
            ->setSipCode($this->getSipCode())
            ->setSipReason($this->getSipReason())
            ->setSrcIp($this->getSrcIp())
            ->setFromUser($this->getFromUser())
            ->setFromDomain($this->getFromDomain())
            ->setRuriUser($this->getRuriUser())
            ->setRuriDomain($this->getRuriDomain())
            ->setCseq($this->getCseq())
            ->setLocaltime($this->getLocaltime())
            ->setUtctime($this->getUtctime());
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'method' => self::getMethod(),
            'from_tag' => self::getFromTag(),
            'to_tag' => self::getToTag(),
            'callid' => self::getCallid(),
            'sip_code' => self::getSipCode(),
            'sip_reason' => self::getSipReason(),
            'src_ip' => self::getSrcIp(),
            'from_user' => self::getFromUser(),
            'from_domain' => self::getFromDomain(),
            'ruri_user' => self::getRuriUser(),
            'ruri_domain' => self::getRuriDomain(),
            'cseq' => self::getCseq(),
            'localtime' => self::getLocaltime(),
            'utctime' => self::getUtctime()
        ];
    }


    // @codeCoverageIgnoreStart

    /**
     * Set method
     *
     * @param string $method
     *
     * @return self
     */
    public function setMethod($method)
    {
        Assertion::notNull($method);
        Assertion::maxLength($method, 16);

        $this->method = $method;

        return $this;
    }

    /**
     * Get method
     *
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Set fromTag
     *
     * @param string $fromTag
     *
     * @return self
     */
    public function setFromTag($fromTag)
    {
        Assertion::notNull($fromTag);
        Assertion::maxLength($fromTag, 64);

        $this->fromTag = $fromTag;

        return $this;
    }

    /**
     * Get fromTag
     *
     * @return string
     */
    public function getFromTag()
    {
        return $this->fromTag;
    }

    /**
     * Set toTag
     *
     * @param string $toTag
     *
     * @return self
     */
    public function setToTag($toTag)
    {
        Assertion::notNull($toTag);
        Assertion::maxLength($toTag, 64);

        $this->toTag = $toTag;

        return $this;
    }

    /**
     * Get toTag
     *
     * @return string
     */
    public function getToTag()
    {
        return $this->toTag;
    }

    /**
     * Set callid
     *
     * @param string $callid
     *
     * @return self
     */
    public function setCallid($callid)
    {
        Assertion::notNull($callid);
        Assertion::maxLength($callid, 255);

        $this->callid = $callid;

        return $this;
    }

    /**
     * Get callid
     *
     * @return string
     */
    public function getCallid()
    {
        return $this->callid;
    }

    /**
     * Set sipCode
     *
     * @param string $sipCode
     *
     * @return self
     */
    public function setSipCode($sipCode)
    {
        Assertion::notNull($sipCode);
        Assertion::maxLength($sipCode, 3);

        $this->sipCode = $sipCode;

        return $this;
    }

    /**
     * Get sipCode
     *
     * @return string
     */
    public function getSipCode()
    {
        return $this->sipCode;
    }

    /**
     * Set sipReason
     *
     * @param string $sipReason
     *
     * @return self
     */
    public function setSipReason($sipReason)
    {
        Assertion::notNull($sipReason);
        Assertion::maxLength($sipReason, 128);

        $this->sipReason = $sipReason;

        return $this;
    }

    /**
     * Get sipReason
     *
     * @return string
     */
    public function getSipReason()
    {
        return $this->sipReason;
    }

    /**
     * Set srcIp
     *
     * @param string $srcIp
     *
     * @return self
     */
    public function setSrcIp($srcIp = null)
    {
        if (!is_null($srcIp)) {
            Assertion::maxLength($srcIp, 64);
        }

        $this->srcIp = $srcIp;

        return $this;
    }

    /**
     * Get srcIp
     *
     * @return string
     */
    public function getSrcIp()
    {
        return $this->srcIp;
    }

    /**
     * Set fromUser
     *
     * @param string $fromUser
     *
     * @return self
     */
    public function setFromUser($fromUser = null)
    {
        if (!is_null($fromUser)) {
            Assertion::maxLength($fromUser, 64);
        }

        $this->fromUser = $fromUser;

        return $this;
    }

    /**
     * Get fromUser
     *
     * @return string
     */
    public function getFromUser()
    {
        return $this->fromUser;
    }

    /**
     * Set fromDomain
     *
     * @param string $fromDomain
     *
     * @return self
     */
    public function setFromDomain($fromDomain = null)
    {
        if (!is_null($fromDomain)) {
            Assertion::maxLength($fromDomain, 190);
        }

        $this->fromDomain = $fromDomain;

        return $this;
    }

    /**
     * Get fromDomain
     *
     * @return string
     */
    public function getFromDomain()
    {
        return $this->fromDomain;
    }

    /**
     * Set ruriUser
     *
     * @param string $ruriUser
     *
     * @return self
     */
    public function setRuriUser($ruriUser = null)
    {
        if (!is_null($ruriUser)) {
            Assertion::maxLength($ruriUser, 64);
        }

        $this->ruriUser = $ruriUser;

        return $this;
    }

    /**
     * Get ruriUser
     *
     * @return string
     */
    public function getRuriUser()
    {
        return $this->ruriUser;
    }

    /**
     * Set ruriDomain
     *
     * @param string $ruriDomain
     *
     * @return self
     */
    public function setRuriDomain($ruriDomain = null)
    {
        if (!is_null($ruriDomain)) {
            Assertion::maxLength($ruriDomain, 190);
        }

        $this->ruriDomain = $ruriDomain;

        return $this;
    }

    /**
     * Get ruriDomain
     *
     * @return string
     */
    public function getRuriDomain()
    {
        return $this->ruriDomain;
    }

    /**
     * Set cseq
     *
     * @param integer $cseq
     *
     * @return self
     */
    public function setCseq($cseq = null)
    {
        if (!is_null($cseq)) {
            if (!is_null($cseq)) {
                Assertion::integerish($cseq);
                Assertion::greaterOrEqualThan($cseq, 0);
            }
        }

        $this->cseq = $cseq;

        return $this;
    }

    /**
     * Get cseq
     *
     * @return integer
     */
    public function getCseq()
    {
        return $this->cseq;
    }

    /**
     * Set localtime
     *
     * @param \DateTime $localtime
     *
     * @return self
     */
    public function setLocaltime($localtime)
    {
        Assertion::notNull($localtime);
        $localtime = \Ivoz\Core\Domain\Model\Helper\DateTimeHelper::createOrFix(
            $localtime,
            null
        );

        $this->localtime = $localtime;

        return $this;
    }

    /**
     * Get localtime
     *
     * @return \DateTime
     */
    public function getLocaltime()
    {
        return $this->localtime;
    }

    /**
     * Set utctime
     *
     * @param string $utctime
     *
     * @return self
     */
    public function setUtctime($utctime = null)
    {
        if (!is_null($utctime)) {
            Assertion::maxLength($utctime, 128);
        }

        $this->utctime = $utctime;

        return $this;
    }

    /**
     * Get utctime
     *
     * @return string
     */
    public function getUtctime()
    {
        return $this->utctime;
    }



    // @codeCoverageIgnoreEnd
}

