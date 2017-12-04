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
    protected function __construct(
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
     * @return void
     * @throws \Exception
     */
    protected function sanitizeValues()
    {
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

        $self
            ->setSrcIp($dto->getSrcIp())
            ->setFromUser($dto->getFromUser())
            ->setFromDomain($dto->getFromDomain())
            ->setRuriUser($dto->getRuriUser())
            ->setRuriDomain($dto->getRuriDomain())
            ->setCseq($dto->getCseq())
            ->setUtctime($dto->getUtctime())
        ;

        $self->sanitizeValues();
        $self->initChangelog();

        return $self;
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



        $this->sanitizeValues();
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
        Assertion::notNull($method, 'method value "%s" is null, but non null value was expected.');
        Assertion::maxLength($method, 16, 'method value "%s" is too long, it should have no more than %d characters, but has %d characters.');

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
        Assertion::notNull($fromTag, 'fromTag value "%s" is null, but non null value was expected.');
        Assertion::maxLength($fromTag, 64, 'fromTag value "%s" is too long, it should have no more than %d characters, but has %d characters.');

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
        Assertion::notNull($toTag, 'toTag value "%s" is null, but non null value was expected.');
        Assertion::maxLength($toTag, 64, 'toTag value "%s" is too long, it should have no more than %d characters, but has %d characters.');

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
        Assertion::notNull($callid, 'callid value "%s" is null, but non null value was expected.');
        Assertion::maxLength($callid, 255, 'callid value "%s" is too long, it should have no more than %d characters, but has %d characters.');

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
        Assertion::notNull($sipCode, 'sipCode value "%s" is null, but non null value was expected.');
        Assertion::maxLength($sipCode, 3, 'sipCode value "%s" is too long, it should have no more than %d characters, but has %d characters.');

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
        Assertion::notNull($sipReason, 'sipReason value "%s" is null, but non null value was expected.');
        Assertion::maxLength($sipReason, 128, 'sipReason value "%s" is too long, it should have no more than %d characters, but has %d characters.');

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
            Assertion::maxLength($srcIp, 64, 'srcIp value "%s" is too long, it should have no more than %d characters, but has %d characters.');
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
            Assertion::maxLength($fromUser, 64, 'fromUser value "%s" is too long, it should have no more than %d characters, but has %d characters.');
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
            Assertion::maxLength($fromDomain, 190, 'fromDomain value "%s" is too long, it should have no more than %d characters, but has %d characters.');
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
            Assertion::maxLength($ruriUser, 64, 'ruriUser value "%s" is too long, it should have no more than %d characters, but has %d characters.');
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
            Assertion::maxLength($ruriDomain, 190, 'ruriDomain value "%s" is too long, it should have no more than %d characters, but has %d characters.');
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
                Assertion::integerish($cseq, 'cseq value "%s" is not an integer or a number castable to integer.');
                Assertion::greaterOrEqualThan($cseq, 0, 'cseq provided "%s" is not greater or equal than "%s".');
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
        Assertion::notNull($localtime, 'localtime value "%s" is null, but non null value was expected.');
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
            Assertion::maxLength($utctime, 128, 'utctime value "%s" is too long, it should have no more than %d characters, but has %d characters.');
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

