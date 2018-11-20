<?php

namespace Ivoz\Ast\Domain\Model\PsEndpoint;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * PsEndpointAbstract
 * @codeCoverageIgnore
 */
abstract class PsEndpointAbstract
{
    /**
     * column: sorcery_id
     * @var string
     */
    protected $sorceryId;

    /**
     * column: from_domain
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
     * column: direct_media
     * @var string
     */
    protected $directMedia = 'yes';

    /**
     * column: direct_media_method
     * comment: enum:update|invite|reinvite
     * @var string
     */
    protected $directMediaMethod = 'update';

    /**
     * @var string
     */
    protected $mailboxes;

    /**
     * column: named_pickup_group
     * @var string
     */
    protected $namedPickupGroup;

    /**
     * column: send_diversion
     * @var string
     */
    protected $sendDiversion = 'yes';

    /**
     * column: send_pai
     * @var string
     */
    protected $sendPai = 'yes';

    /**
     * column: 100rel
     * @var string
     */
    protected $oneHundredRel = 'no';

    /**
     * column: outbound_proxy
     * @var string
     */
    protected $outboundProxy;

    /**
     * column: trust_id_inbound
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
     * @var \Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface
     */
    protected $residentialDevice;


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct(
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
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "PsEndpoint",
            $this->getId()
        );
    }

    /**
     * @return void
     * @throws \Exception
     */
    protected function sanitizeValues()
    {
    }

    /**
     * @param null $id
     * @return PsEndpointDto
     */
    public static function createDto($id = null)
    {
        return new PsEndpointDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param EntityInterface|null $entity
     * @param int $depth
     * @return PsEndpointDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, PsEndpointInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        return $entity->toDto($depth-1);
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto PsEndpointDto
         */
        Assertion::isInstanceOf($dto, PsEndpointDto::class);

        $self = new static(
            $dto->getSorceryId(),
            $dto->getContext(),
            $dto->getDisallow(),
            $dto->getAllow(),
            $dto->getOneHundredRel()
        );

        $self
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
            ->setResidentialDevice($dto->getResidentialDevice())
        ;

        $self->sanitizeValues();
        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto PsEndpointDto
         */
        Assertion::isInstanceOf($dto, PsEndpointDto::class);

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
            ->setResidentialDevice($dto->getResidentialDevice());



        $this->sanitizeValues();
        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return PsEndpointDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setSorceryId(self::getSorceryId())
            ->setFromDomain(self::getFromDomain())
            ->setAors(self::getAors())
            ->setCallerid(self::getCallerid())
            ->setContext(self::getContext())
            ->setDisallow(self::getDisallow())
            ->setAllow(self::getAllow())
            ->setDirectMedia(self::getDirectMedia())
            ->setDirectMediaMethod(self::getDirectMediaMethod())
            ->setMailboxes(self::getMailboxes())
            ->setNamedPickupGroup(self::getNamedPickupGroup())
            ->setSendDiversion(self::getSendDiversion())
            ->setSendPai(self::getSendPai())
            ->setOneHundredRel(self::getOneHundredRel())
            ->setOutboundProxy(self::getOutboundProxy())
            ->setTrustIdInbound(self::getTrustIdInbound())
            ->setTerminal(\Ivoz\Provider\Domain\Model\Terminal\Terminal::entityToDto(self::getTerminal(), $depth))
            ->setFriend(\Ivoz\Provider\Domain\Model\Friend\Friend::entityToDto(self::getFriend(), $depth))
            ->setResidentialDevice(\Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDevice::entityToDto(self::getResidentialDevice(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'sorcery_id' => self::getSorceryId(),
            'from_domain' => self::getFromDomain(),
            'aors' => self::getAors(),
            'callerid' => self::getCallerid(),
            'context' => self::getContext(),
            'disallow' => self::getDisallow(),
            'allow' => self::getAllow(),
            'direct_media' => self::getDirectMedia(),
            'direct_media_method' => self::getDirectMediaMethod(),
            'mailboxes' => self::getMailboxes(),
            'named_pickup_group' => self::getNamedPickupGroup(),
            'send_diversion' => self::getSendDiversion(),
            'send_pai' => self::getSendPai(),
            '100rel' => self::getOneHundredRel(),
            'outbound_proxy' => self::getOutboundProxy(),
            'trust_id_inbound' => self::getTrustIdInbound(),
            'terminalId' => self::getTerminal() ? self::getTerminal()->getId() : null,
            'friendId' => self::getFriend() ? self::getFriend()->getId() : null,
            'residentialDeviceId' => self::getResidentialDevice() ? self::getResidentialDevice()->getId() : null
        ];
    }
    // @codeCoverageIgnoreStart

    /**
     * @deprecated
     * Set sorceryId
     *
     * @param string $sorceryId
     *
     * @return self
     */
    public function setSorceryId($sorceryId)
    {
        Assertion::notNull($sorceryId, 'sorceryId value "%s" is null, but non null value was expected.');
        Assertion::maxLength($sorceryId, 40, 'sorceryId value "%s" is too long, it should have no more than %d characters, but has %d characters.');

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
     * @deprecated
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
     * @deprecated
     * Set aors
     *
     * @param string $aors
     *
     * @return self
     */
    public function setAors($aors = null)
    {
        if (!is_null($aors)) {
            Assertion::maxLength($aors, 200, 'aors value "%s" is too long, it should have no more than %d characters, but has %d characters.');
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
     * @deprecated
     * Set callerid
     *
     * @param string $callerid
     *
     * @return self
     */
    public function setCallerid($callerid = null)
    {
        if (!is_null($callerid)) {
            Assertion::maxLength($callerid, 100, 'callerid value "%s" is too long, it should have no more than %d characters, but has %d characters.');
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
     * @deprecated
     * Set context
     *
     * @param string $context
     *
     * @return self
     */
    public function setContext($context)
    {
        Assertion::notNull($context, 'context value "%s" is null, but non null value was expected.');
        Assertion::maxLength($context, 40, 'context value "%s" is too long, it should have no more than %d characters, but has %d characters.');

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
     * @deprecated
     * Set disallow
     *
     * @param string $disallow
     *
     * @return self
     */
    public function setDisallow($disallow)
    {
        Assertion::notNull($disallow, 'disallow value "%s" is null, but non null value was expected.');
        Assertion::maxLength($disallow, 200, 'disallow value "%s" is too long, it should have no more than %d characters, but has %d characters.');

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
     * @deprecated
     * Set allow
     *
     * @param string $allow
     *
     * @return self
     */
    public function setAllow($allow)
    {
        Assertion::notNull($allow, 'allow value "%s" is null, but non null value was expected.');
        Assertion::maxLength($allow, 200, 'allow value "%s" is too long, it should have no more than %d characters, but has %d characters.');

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
     * @deprecated
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
     * @deprecated
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
            ), 'directMediaMethodvalue "%s" is not an element of the valid values: %s');
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
     * @deprecated
     * Set mailboxes
     *
     * @param string $mailboxes
     *
     * @return self
     */
    public function setMailboxes($mailboxes = null)
    {
        if (!is_null($mailboxes)) {
            Assertion::maxLength($mailboxes, 100, 'mailboxes value "%s" is too long, it should have no more than %d characters, but has %d characters.');
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
     * @deprecated
     * Set namedPickupGroup
     *
     * @param string $namedPickupGroup
     *
     * @return self
     */
    public function setNamedPickupGroup($namedPickupGroup = null)
    {
        if (!is_null($namedPickupGroup)) {
            Assertion::maxLength($namedPickupGroup, 40, 'namedPickupGroup value "%s" is too long, it should have no more than %d characters, but has %d characters.');
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
     * @deprecated
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
     * @deprecated
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
     * @deprecated
     * Set oneHundredRel
     *
     * @param string $oneHundredRel
     *
     * @return self
     */
    public function setOneHundredRel($oneHundredRel)
    {
        Assertion::notNull($oneHundredRel, 'oneHundredRel value "%s" is null, but non null value was expected.');

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
     * @deprecated
     * Set outboundProxy
     *
     * @param string $outboundProxy
     *
     * @return self
     */
    public function setOutboundProxy($outboundProxy = null)
    {
        if (!is_null($outboundProxy)) {
            Assertion::maxLength($outboundProxy, 256, 'outboundProxy value "%s" is too long, it should have no more than %d characters, but has %d characters.');
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
     * @deprecated
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
     * Set residentialDevice
     *
     * @param \Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface $residentialDevice
     *
     * @return self
     */
    public function setResidentialDevice(\Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface $residentialDevice = null)
    {
        $this->residentialDevice = $residentialDevice;

        return $this;
    }

    /**
     * Get residentialDevice
     *
     * @return \Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface
     */
    public function getResidentialDevice()
    {
        return $this->residentialDevice;
    }

    // @codeCoverageIgnoreEnd
}
