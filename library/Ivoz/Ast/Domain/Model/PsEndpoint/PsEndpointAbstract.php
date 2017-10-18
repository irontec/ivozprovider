<?php

namespace Ivoz\Ast\Domain\Model\PsEndpoint;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;

/**
 * PsEndpointAbstract
 * @codeCoverageIgnore
 */
abstract class PsEndpointAbstract
{
    /**
     * @column sorcery_id
     * @var string
     */
    protected $sorceryId;

    /**
     * @column from_domain
     * @var string
     */
    protected $fromDomain;

    /**
     * @var string
     */
    protected $aors;

    /**
     * @var string
     */
    protected $callerid;

    /**
     * @var string
     */
    protected $context = 'users';

    /**
     * @var string
     */
    protected $disallow = 'all';

    /**
     * @var string
     */
    protected $allow = 'all';

    /**
     * @column direct_media
     * @var string
     */
    protected $directMedia = 'yes';

    /**
     * @column direct_media_method
     * @comment enum:update|invite|reinvite
     * @var string
     */
    protected $directMediaMethod = 'update';

    /**
     * @var string
     */
    protected $mailboxes;

    /**
     * @column named_pickup_group
     * @var string
     */
    protected $namedPickupGroup;

    /**
     * @column send_diversion
     * @var string
     */
    protected $sendDiversion = 'yes';

    /**
     * @column send_pai
     * @var string
     */
    protected $sendPai = 'yes';

    /**
     * @column 100rel
     * @var string
     */
    protected $oneHundredRel = 'no';

    /**
     * @column outbound_proxy
     * @var string
     */
    protected $outboundProxy;

    /**
     * @column trust_id_inbound
     * @var string
     */
    protected $trustIdInbound;

    /**
     * @var \Ivoz\Provider\Domain\Model\Terminal\TerminalInterface
     */
    protected $terminal;

    /**
     * @var \Ivoz\Provider\Domain\Model\Friend\FriendInterface
     */
    protected $friend;

    /**
     * @var \Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface
     */
    protected $retailAccount;


    /**
     * Changelog tracking purpose
     * @var array
     */
    protected $_initialValues = [];

    /**
     * Constructor
     */
    public function __construct(
        $sorceryId,
        $context,
        $disallow,
        $allow,
        $oneHundredRel
    ) {
        $this->setSorceryId($sorceryId);
        $this->setContext($context);
        $this->setDisallow($disallow);
        $this->setAllow($allow);
        $this->setOneHundredRel($oneHundredRel);

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
    public function hasChanged($fieldName)
    {
        if (!array_key_exists($fieldName, $this->_initialValues)) {
            throw new \Exception($fieldName . ' field was not found');
        }
        $currentValues = $this->__toArray();

        return $currentValues[$fieldName] != $this->_initialValues[$fieldName];
    }

    public function getInitialValue($fieldName)
    {
        if (!array_key_exists($fieldName, $this->_initialValues)) {
            throw new \Exception($fieldName . ' field was not found');
        }

        return $this->_initialValues[$fieldName];
    }

    /**
     * @return PsEndpointDTO
     */
    public static function createDTO()
    {
        return new PsEndpointDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto PsEndpointDTO
         */
        Assertion::isInstanceOf($dto, PsEndpointDTO::class);

        $self = new static(
            $dto->getSorceryId(),
            $dto->getContext(),
            $dto->getDisallow(),
            $dto->getAllow(),
            $dto->getOneHundredRel());

        return $self
            ->setFromDomain($dto->getFromDomain())
            ->setAors($dto->getAors())
            ->setCallerid($dto->getCallerid())
            ->setDirectMedia($dto->getDirectMedia())
            ->setDirectMediaMethod($dto->getDirectMediaMethod())
            ->setMailboxes($dto->getMailboxes())
            ->setNamedPickupGroup($dto->getNamedPickupGroup())
            ->setSendDiversion($dto->getSendDiversion())
            ->setSendPai($dto->getSendPai())
            ->setOutboundProxy($dto->getOutboundProxy())
            ->setTrustIdInbound($dto->getTrustIdInbound())
            ->setTerminal($dto->getTerminal())
            ->setFriend($dto->getFriend())
            ->setRetailAccount($dto->getRetailAccount())
        ;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto PsEndpointDTO
         */
        Assertion::isInstanceOf($dto, PsEndpointDTO::class);

        $this
            ->setSorceryId($dto->getSorceryId())
            ->setFromDomain($dto->getFromDomain())
            ->setAors($dto->getAors())
            ->setCallerid($dto->getCallerid())
            ->setContext($dto->getContext())
            ->setDisallow($dto->getDisallow())
            ->setAllow($dto->getAllow())
            ->setDirectMedia($dto->getDirectMedia())
            ->setDirectMediaMethod($dto->getDirectMediaMethod())
            ->setMailboxes($dto->getMailboxes())
            ->setNamedPickupGroup($dto->getNamedPickupGroup())
            ->setSendDiversion($dto->getSendDiversion())
            ->setSendPai($dto->getSendPai())
            ->setOneHundredRel($dto->getOneHundredRel())
            ->setOutboundProxy($dto->getOutboundProxy())
            ->setTrustIdInbound($dto->getTrustIdInbound())
            ->setTerminal($dto->getTerminal())
            ->setFriend($dto->getFriend())
            ->setRetailAccount($dto->getRetailAccount());


        return $this;
    }

    /**
     * @return PsEndpointDTO
     */
    public function toDTO()
    {
        return self::createDTO()
            ->setSorceryId($this->getSorceryId())
            ->setFromDomain($this->getFromDomain())
            ->setAors($this->getAors())
            ->setCallerid($this->getCallerid())
            ->setContext($this->getContext())
            ->setDisallow($this->getDisallow())
            ->setAllow($this->getAllow())
            ->setDirectMedia($this->getDirectMedia())
            ->setDirectMediaMethod($this->getDirectMediaMethod())
            ->setMailboxes($this->getMailboxes())
            ->setNamedPickupGroup($this->getNamedPickupGroup())
            ->setSendDiversion($this->getSendDiversion())
            ->setSendPai($this->getSendPai())
            ->setOneHundredRel($this->getOneHundredRel())
            ->setOutboundProxy($this->getOutboundProxy())
            ->setTrustIdInbound($this->getTrustIdInbound())
            ->setTerminalId($this->getTerminal() ? $this->getTerminal()->getId() : null)
            ->setFriendId($this->getFriend() ? $this->getFriend()->getId() : null)
            ->setRetailAccountId($this->getRetailAccount() ? $this->getRetailAccount()->getId() : null);
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'sorceryId' => self::getSorceryId(),
            'fromDomain' => self::getFromDomain(),
            'aors' => self::getAors(),
            'callerid' => self::getCallerid(),
            'context' => self::getContext(),
            'disallow' => self::getDisallow(),
            'allow' => self::getAllow(),
            'directMedia' => self::getDirectMedia(),
            'directMediaMethod' => self::getDirectMediaMethod(),
            'mailboxes' => self::getMailboxes(),
            'namedPickupGroup' => self::getNamedPickupGroup(),
            'sendDiversion' => self::getSendDiversion(),
            'sendPai' => self::getSendPai(),
            'oneHundredRel' => self::getOneHundredRel(),
            'outboundProxy' => self::getOutboundProxy(),
            'trustIdInbound' => self::getTrustIdInbound(),
            'terminalId' => self::getTerminal() ? self::getTerminal()->getId() : null,
            'friendId' => self::getFriend() ? self::getFriend()->getId() : null,
            'retailAccountId' => self::getRetailAccount() ? self::getRetailAccount()->getId() : null
        ];
    }


    // @codeCoverageIgnoreStart

    /**
     * Set sorceryId
     *
     * @param string $sorceryId
     *
     * @return self
     */
    public function setSorceryId($sorceryId)
    {
        Assertion::notNull($sorceryId);
        Assertion::maxLength($sorceryId, 40);

        $this->sorceryId = $sorceryId;

        return $this;
    }

    /**
     * Get sorceryId
     *
     * @return string
     */
    public function getSorceryId()
    {
        return $this->sorceryId;
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
     * Set aors
     *
     * @param string $aors
     *
     * @return self
     */
    public function setAors($aors = null)
    {
        if (!is_null($aors)) {
            Assertion::maxLength($aors, 200);
        }

        $this->aors = $aors;

        return $this;
    }

    /**
     * Get aors
     *
     * @return string
     */
    public function getAors()
    {
        return $this->aors;
    }

    /**
     * Set callerid
     *
     * @param string $callerid
     *
     * @return self
     */
    public function setCallerid($callerid = null)
    {
        if (!is_null($callerid)) {
            Assertion::maxLength($callerid, 100);
        }

        $this->callerid = $callerid;

        return $this;
    }

    /**
     * Get callerid
     *
     * @return string
     */
    public function getCallerid()
    {
        return $this->callerid;
    }

    /**
     * Set context
     *
     * @param string $context
     *
     * @return self
     */
    public function setContext($context)
    {
        Assertion::notNull($context);
        Assertion::maxLength($context, 40);

        $this->context = $context;

        return $this;
    }

    /**
     * Get context
     *
     * @return string
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * Set disallow
     *
     * @param string $disallow
     *
     * @return self
     */
    public function setDisallow($disallow)
    {
        Assertion::notNull($disallow);
        Assertion::maxLength($disallow, 200);

        $this->disallow = $disallow;

        return $this;
    }

    /**
     * Get disallow
     *
     * @return string
     */
    public function getDisallow()
    {
        return $this->disallow;
    }

    /**
     * Set allow
     *
     * @param string $allow
     *
     * @return self
     */
    public function setAllow($allow)
    {
        Assertion::notNull($allow);
        Assertion::maxLength($allow, 200);

        $this->allow = $allow;

        return $this;
    }

    /**
     * Get allow
     *
     * @return string
     */
    public function getAllow()
    {
        return $this->allow;
    }

    /**
     * Set directMedia
     *
     * @param string $directMedia
     *
     * @return self
     */
    public function setDirectMedia($directMedia = null)
    {
        if (!is_null($directMedia)) {
        }

        $this->directMedia = $directMedia;

        return $this;
    }

    /**
     * Get directMedia
     *
     * @return string
     */
    public function getDirectMedia()
    {
        return $this->directMedia;
    }

    /**
     * Set directMediaMethod
     *
     * @param string $directMediaMethod
     *
     * @return self
     */
    public function setDirectMediaMethod($directMediaMethod = null)
    {
        if (!is_null($directMediaMethod)) {
        Assertion::choice($directMediaMethod, array (
          0 => 'update',
          1 => 'invite',
          2 => 'reinvite',
        ));
        }

        $this->directMediaMethod = $directMediaMethod;

        return $this;
    }

    /**
     * Get directMediaMethod
     *
     * @return string
     */
    public function getDirectMediaMethod()
    {
        return $this->directMediaMethod;
    }

    /**
     * Set mailboxes
     *
     * @param string $mailboxes
     *
     * @return self
     */
    public function setMailboxes($mailboxes = null)
    {
        if (!is_null($mailboxes)) {
            Assertion::maxLength($mailboxes, 100);
        }

        $this->mailboxes = $mailboxes;

        return $this;
    }

    /**
     * Get mailboxes
     *
     * @return string
     */
    public function getMailboxes()
    {
        return $this->mailboxes;
    }

    /**
     * Set namedPickupGroup
     *
     * @param string $namedPickupGroup
     *
     * @return self
     */
    public function setNamedPickupGroup($namedPickupGroup = null)
    {
        if (!is_null($namedPickupGroup)) {
            Assertion::maxLength($namedPickupGroup, 40);
        }

        $this->namedPickupGroup = $namedPickupGroup;

        return $this;
    }

    /**
     * Get namedPickupGroup
     *
     * @return string
     */
    public function getNamedPickupGroup()
    {
        return $this->namedPickupGroup;
    }

    /**
     * Set sendDiversion
     *
     * @param string $sendDiversion
     *
     * @return self
     */
    public function setSendDiversion($sendDiversion = null)
    {
        if (!is_null($sendDiversion)) {
        }

        $this->sendDiversion = $sendDiversion;

        return $this;
    }

    /**
     * Get sendDiversion
     *
     * @return string
     */
    public function getSendDiversion()
    {
        return $this->sendDiversion;
    }

    /**
     * Set sendPai
     *
     * @param string $sendPai
     *
     * @return self
     */
    public function setSendPai($sendPai = null)
    {
        if (!is_null($sendPai)) {
        }

        $this->sendPai = $sendPai;

        return $this;
    }

    /**
     * Get sendPai
     *
     * @return string
     */
    public function getSendPai()
    {
        return $this->sendPai;
    }

    /**
     * Set oneHundredRel
     *
     * @param string $oneHundredRel
     *
     * @return self
     */
    public function setOneHundredRel($oneHundredRel)
    {
        Assertion::notNull($oneHundredRel);

        $this->oneHundredRel = $oneHundredRel;

        return $this;
    }

    /**
     * Get oneHundredRel
     *
     * @return string
     */
    public function getOneHundredRel()
    {
        return $this->oneHundredRel;
    }

    /**
     * Set outboundProxy
     *
     * @param string $outboundProxy
     *
     * @return self
     */
    public function setOutboundProxy($outboundProxy = null)
    {
        if (!is_null($outboundProxy)) {
            Assertion::maxLength($outboundProxy, 256);
        }

        $this->outboundProxy = $outboundProxy;

        return $this;
    }

    /**
     * Get outboundProxy
     *
     * @return string
     */
    public function getOutboundProxy()
    {
        return $this->outboundProxy;
    }

    /**
     * Set trustIdInbound
     *
     * @param string $trustIdInbound
     *
     * @return self
     */
    public function setTrustIdInbound($trustIdInbound = null)
    {
        if (!is_null($trustIdInbound)) {
        }

        $this->trustIdInbound = $trustIdInbound;

        return $this;
    }

    /**
     * Get trustIdInbound
     *
     * @return string
     */
    public function getTrustIdInbound()
    {
        return $this->trustIdInbound;
    }

    /**
     * Set terminal
     *
     * @param \Ivoz\Provider\Domain\Model\Terminal\TerminalInterface $terminal
     *
     * @return self
     */
    public function setTerminal(\Ivoz\Provider\Domain\Model\Terminal\TerminalInterface $terminal = null)
    {
        $this->terminal = $terminal;

        return $this;
    }

    /**
     * Get terminal
     *
     * @return \Ivoz\Provider\Domain\Model\Terminal\TerminalInterface
     */
    public function getTerminal()
    {
        return $this->terminal;
    }

    /**
     * Set friend
     *
     * @param \Ivoz\Provider\Domain\Model\Friend\FriendInterface $friend
     *
     * @return self
     */
    public function setFriend(\Ivoz\Provider\Domain\Model\Friend\FriendInterface $friend = null)
    {
        $this->friend = $friend;

        return $this;
    }

    /**
     * Get friend
     *
     * @return \Ivoz\Provider\Domain\Model\Friend\FriendInterface
     */
    public function getFriend()
    {
        return $this->friend;
    }

    /**
     * Set retailAccount
     *
     * @param \Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface $retailAccount
     *
     * @return self
     */
    public function setRetailAccount(\Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface $retailAccount = null)
    {
        $this->retailAccount = $retailAccount;

        return $this;
    }

    /**
     * Get retailAccount
     *
     * @return \Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface
     */
    public function getRetailAccount()
    {
        return $this->retailAccount;
    }



    // @codeCoverageIgnoreEnd
}

