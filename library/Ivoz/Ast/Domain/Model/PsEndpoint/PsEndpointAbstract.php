<?php
declare(strict_types = 1);

namespace Ivoz\Ast\Domain\Model\PsEndpoint;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Terminal\TerminalInterface;
use Ivoz\Provider\Domain\Model\Friend\FriendInterface;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface;
use Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface;
use Ivoz\Provider\Domain\Model\Terminal\Terminal;
use Ivoz\Provider\Domain\Model\Friend\Friend;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDevice;
use Ivoz\Provider\Domain\Model\RetailAccount\RetailAccount;

/**
* PsEndpointAbstract
* @codeCoverageIgnore
*/
abstract class PsEndpointAbstract
{
    use ChangelogTrait;

    /**
     * column: sorcery_id
     * @var string
     */
    protected $sorceryId;

    /**
     * column: from_domain
     * @var string | null
     */
    protected $fromDomain;

    /**
     * @var string | null
     */
    protected $aors;

    /**
     * @var string | null
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
     * @var string | null
     */
    protected $directMedia = 'yes';

    /**
     * column: direct_media_method
     * comment: enum:update|invite|reinvite
     * @var string | null
     */
    protected $directMediaMethod = 'update';

    /**
     * @var string | null
     */
    protected $mailboxes;

    /**
     * column: named_pickup_group
     * @var string | null
     */
    protected $namedPickupGroup;

    /**
     * column: send_diversion
     * @var string | null
     */
    protected $sendDiversion = 'yes';

    /**
     * column: send_pai
     * @var string | null
     */
    protected $sendPai = 'yes';

    /**
     * column: 100rel
     * @var string
     */
    protected $oneHundredRel = 'no';

    /**
     * column: outbound_proxy
     * @var string | null
     */
    protected $outboundProxy;

    /**
     * column: trust_id_inbound
     * @var string | null
     */
    protected $trustIdInbound;

    /**
     * column: t38_udptl
     * comment: enum:yes|no
     * @var string
     */
    protected $t38Udptl = 'no';

    /**
     * column: t38_udptl_ec
     * comment: enum:none|fec|redundancy
     * @var string
     */
    protected $t38UdptlEc = 'redundancy';

    /**
     * column: t38_udptl_maxdatagram
     * @var int
     */
    protected $t38UdptlMaxdatagram = 1440;

    /**
     * column: t38_udptl_nat
     * comment: enum:yes|no
     * @var string
     */
    protected $t38UdptlNat = 'no';

    /**
     * @var TerminalInterface
     * inversedBy astPsEndpoints
     */
    protected $terminal;

    /**
     * @var FriendInterface
     * inversedBy psEndpoints
     */
    protected $friend;

    /**
     * @var ResidentialDeviceInterface
     * inversedBy psEndpoints
     */
    protected $residentialDevice;

    /**
     * @var RetailAccountInterface
     * inversedBy psEndpoints
     */
    protected $retailAccount;

    /**
     * Constructor
     */
    protected function __construct(
        $sorceryId,
        $context,
        $disallow,
        $allow,
        $oneHundredRel,
        $t38Udptl,
        $t38UdptlEc,
        $t38UdptlMaxdatagram,
        $t38UdptlNat
    ) {
        $this->setSorceryId($sorceryId);
        $this->setContext($context);
        $this->setDisallow($disallow);
        $this->setAllow($allow);
        $this->setOneHundredRel($oneHundredRel);
        $this->setT38Udptl($t38Udptl);
        $this->setT38UdptlEc($t38UdptlEc);
        $this->setT38UdptlMaxdatagram($t38UdptlMaxdatagram);
        $this->setT38UdptlNat($t38UdptlNat);
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
     * @param PsEndpointInterface|null $entity
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

        /** @var PsEndpointDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param PsEndpointDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, PsEndpointDto::class);

        $self = new static(
            $dto->getSorceryId(),
            $dto->getContext(),
            $dto->getDisallow(),
            $dto->getAllow(),
            $dto->getOneHundredRel(),
            $dto->getT38Udptl(),
            $dto->getT38UdptlEc(),
            $dto->getT38UdptlMaxdatagram(),
            $dto->getT38UdptlNat()
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
            ->setTerminal($fkTransformer->transform($dto->getTerminal()))
            ->setFriend($fkTransformer->transform($dto->getFriend()))
            ->setResidentialDevice($fkTransformer->transform($dto->getResidentialDevice()))
            ->setRetailAccount($fkTransformer->transform($dto->getRetailAccount()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param PsEndpointDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
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
            ->setT38Udptl($dto->getT38Udptl())
            ->setT38UdptlEc($dto->getT38UdptlEc())
            ->setT38UdptlMaxdatagram($dto->getT38UdptlMaxdatagram())
            ->setT38UdptlNat($dto->getT38UdptlNat())
            ->setTerminal($fkTransformer->transform($dto->getTerminal()))
            ->setFriend($fkTransformer->transform($dto->getFriend()))
            ->setResidentialDevice($fkTransformer->transform($dto->getResidentialDevice()))
            ->setRetailAccount($fkTransformer->transform($dto->getRetailAccount()));

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
            ->setT38Udptl(self::getT38Udptl())
            ->setT38UdptlEc(self::getT38UdptlEc())
            ->setT38UdptlMaxdatagram(self::getT38UdptlMaxdatagram())
            ->setT38UdptlNat(self::getT38UdptlNat())
            ->setTerminal(Terminal::entityToDto(self::getTerminal(), $depth))
            ->setFriend(Friend::entityToDto(self::getFriend(), $depth))
            ->setResidentialDevice(ResidentialDevice::entityToDto(self::getResidentialDevice(), $depth))
            ->setRetailAccount(RetailAccount::entityToDto(self::getRetailAccount(), $depth));
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
            't38_udptl' => self::getT38Udptl(),
            't38_udptl_ec' => self::getT38UdptlEc(),
            't38_udptl_maxdatagram' => self::getT38UdptlMaxdatagram(),
            't38_udptl_nat' => self::getT38UdptlNat(),
            'terminalId' => self::getTerminal() ? self::getTerminal()->getId() : null,
            'friendId' => self::getFriend() ? self::getFriend()->getId() : null,
            'residentialDeviceId' => self::getResidentialDevice() ? self::getResidentialDevice()->getId() : null,
            'retailAccountId' => self::getRetailAccount() ? self::getRetailAccount()->getId() : null
        ];
    }

    /**
     * Set sorceryId
     *
     * @param string $sorceryId
     *
     * @return static
     */
    protected function setSorceryId(string $sorceryId): PsEndpointInterface
    {
        Assertion::maxLength($sorceryId, 40, 'sorceryId value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->sorceryId = $sorceryId;

        return $this;
    }

    /**
     * Get sorceryId
     *
     * @return string
     */
    public function getSorceryId(): string
    {
        return $this->sorceryId;
    }

    /**
     * Set fromDomain
     *
     * @param string $fromDomain | null
     *
     * @return static
     */
    protected function setFromDomain(?string $fromDomain = null): PsEndpointInterface
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
     * @return string | null
     */
    public function getFromDomain(): ?string
    {
        return $this->fromDomain;
    }

    /**
     * Set aors
     *
     * @param string $aors | null
     *
     * @return static
     */
    protected function setAors(?string $aors = null): PsEndpointInterface
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
     * @return string | null
     */
    public function getAors(): ?string
    {
        return $this->aors;
    }

    /**
     * Set callerid
     *
     * @param string $callerid | null
     *
     * @return static
     */
    protected function setCallerid(?string $callerid = null): PsEndpointInterface
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
     * @return string | null
     */
    public function getCallerid(): ?string
    {
        return $this->callerid;
    }

    /**
     * Set context
     *
     * @param string $context
     *
     * @return static
     */
    protected function setContext(string $context): PsEndpointInterface
    {
        Assertion::maxLength($context, 40, 'context value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->context = $context;

        return $this;
    }

    /**
     * Get context
     *
     * @return string
     */
    public function getContext(): string
    {
        return $this->context;
    }

    /**
     * Set disallow
     *
     * @param string $disallow
     *
     * @return static
     */
    protected function setDisallow(string $disallow): PsEndpointInterface
    {
        Assertion::maxLength($disallow, 200, 'disallow value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->disallow = $disallow;

        return $this;
    }

    /**
     * Get disallow
     *
     * @return string
     */
    public function getDisallow(): string
    {
        return $this->disallow;
    }

    /**
     * Set allow
     *
     * @param string $allow
     *
     * @return static
     */
    protected function setAllow(string $allow): PsEndpointInterface
    {
        Assertion::maxLength($allow, 200, 'allow value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->allow = $allow;

        return $this;
    }

    /**
     * Get allow
     *
     * @return string
     */
    public function getAllow(): string
    {
        return $this->allow;
    }

    /**
     * Set directMedia
     *
     * @param string $directMedia | null
     *
     * @return static
     */
    protected function setDirectMedia(?string $directMedia = null): PsEndpointInterface
    {
        $this->directMedia = $directMedia;

        return $this;
    }

    /**
     * Get directMedia
     *
     * @return string | null
     */
    public function getDirectMedia(): ?string
    {
        return $this->directMedia;
    }

    /**
     * Set directMediaMethod
     *
     * @param string $directMediaMethod | null
     *
     * @return static
     */
    protected function setDirectMediaMethod(?string $directMediaMethod = null): PsEndpointInterface
    {
        if (!is_null($directMediaMethod)) {
            Assertion::choice(
                $directMediaMethod,
                [
                    PsEndpointInterface::DIRECTMEDIAMETHOD_UPDATE,
                    PsEndpointInterface::DIRECTMEDIAMETHOD_INVITE,
                    PsEndpointInterface::DIRECTMEDIAMETHOD_REINVITE,
                ],
                'directMediaMethodvalue "%s" is not an element of the valid values: %s'
            );
        }

        $this->directMediaMethod = $directMediaMethod;

        return $this;
    }

    /**
     * Get directMediaMethod
     *
     * @return string | null
     */
    public function getDirectMediaMethod(): ?string
    {
        return $this->directMediaMethod;
    }

    /**
     * Set mailboxes
     *
     * @param string $mailboxes | null
     *
     * @return static
     */
    protected function setMailboxes(?string $mailboxes = null): PsEndpointInterface
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
     * @return string | null
     */
    public function getMailboxes(): ?string
    {
        return $this->mailboxes;
    }

    /**
     * Set namedPickupGroup
     *
     * @param string $namedPickupGroup | null
     *
     * @return static
     */
    protected function setNamedPickupGroup(?string $namedPickupGroup = null): PsEndpointInterface
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
     * @return string | null
     */
    public function getNamedPickupGroup(): ?string
    {
        return $this->namedPickupGroup;
    }

    /**
     * Set sendDiversion
     *
     * @param string $sendDiversion | null
     *
     * @return static
     */
    protected function setSendDiversion(?string $sendDiversion = null): PsEndpointInterface
    {
        $this->sendDiversion = $sendDiversion;

        return $this;
    }

    /**
     * Get sendDiversion
     *
     * @return string | null
     */
    public function getSendDiversion(): ?string
    {
        return $this->sendDiversion;
    }

    /**
     * Set sendPai
     *
     * @param string $sendPai | null
     *
     * @return static
     */
    protected function setSendPai(?string $sendPai = null): PsEndpointInterface
    {
        $this->sendPai = $sendPai;

        return $this;
    }

    /**
     * Get sendPai
     *
     * @return string | null
     */
    public function getSendPai(): ?string
    {
        return $this->sendPai;
    }

    /**
     * Set oneHundredRel
     *
     * @param string $oneHundredRel
     *
     * @return static
     */
    protected function setOneHundredRel(string $oneHundredRel): PsEndpointInterface
    {
        $this->oneHundredRel = $oneHundredRel;

        return $this;
    }

    /**
     * Get oneHundredRel
     *
     * @return string
     */
    public function getOneHundredRel(): string
    {
        return $this->oneHundredRel;
    }

    /**
     * Set outboundProxy
     *
     * @param string $outboundProxy | null
     *
     * @return static
     */
    protected function setOutboundProxy(?string $outboundProxy = null): PsEndpointInterface
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
     * @return string | null
     */
    public function getOutboundProxy(): ?string
    {
        return $this->outboundProxy;
    }

    /**
     * Set trustIdInbound
     *
     * @param string $trustIdInbound | null
     *
     * @return static
     */
    protected function setTrustIdInbound(?string $trustIdInbound = null): PsEndpointInterface
    {
        $this->trustIdInbound = $trustIdInbound;

        return $this;
    }

    /**
     * Get trustIdInbound
     *
     * @return string | null
     */
    public function getTrustIdInbound(): ?string
    {
        return $this->trustIdInbound;
    }

    /**
     * Set t38Udptl
     *
     * @param string $t38Udptl
     *
     * @return static
     */
    protected function setT38Udptl(string $t38Udptl): PsEndpointInterface
    {
        Assertion::choice(
            $t38Udptl,
            [
                PsEndpointInterface::T38UDPTL_YES,
                PsEndpointInterface::T38UDPTL_NO,
            ],
            't38Udptlvalue "%s" is not an element of the valid values: %s'
        );

        $this->t38Udptl = $t38Udptl;

        return $this;
    }

    /**
     * Get t38Udptl
     *
     * @return string
     */
    public function getT38Udptl(): string
    {
        return $this->t38Udptl;
    }

    /**
     * Set t38UdptlEc
     *
     * @param string $t38UdptlEc
     *
     * @return static
     */
    protected function setT38UdptlEc(string $t38UdptlEc): PsEndpointInterface
    {
        Assertion::choice(
            $t38UdptlEc,
            [
                PsEndpointInterface::T38UDPTLEC_NONE,
                PsEndpointInterface::T38UDPTLEC_FEC,
                PsEndpointInterface::T38UDPTLEC_REDUNDANCY,
            ],
            't38UdptlEcvalue "%s" is not an element of the valid values: %s'
        );

        $this->t38UdptlEc = $t38UdptlEc;

        return $this;
    }

    /**
     * Get t38UdptlEc
     *
     * @return string
     */
    public function getT38UdptlEc(): string
    {
        return $this->t38UdptlEc;
    }

    /**
     * Set t38UdptlMaxdatagram
     *
     * @param int $t38UdptlMaxdatagram
     *
     * @return static
     */
    protected function setT38UdptlMaxdatagram(int $t38UdptlMaxdatagram): PsEndpointInterface
    {
        Assertion::greaterOrEqualThan($t38UdptlMaxdatagram, 0, 't38UdptlMaxdatagram provided "%s" is not greater or equal than "%s".');

        $this->t38UdptlMaxdatagram = $t38UdptlMaxdatagram;

        return $this;
    }

    /**
     * Get t38UdptlMaxdatagram
     *
     * @return int
     */
    public function getT38UdptlMaxdatagram(): int
    {
        return $this->t38UdptlMaxdatagram;
    }

    /**
     * Set t38UdptlNat
     *
     * @param string $t38UdptlNat
     *
     * @return static
     */
    protected function setT38UdptlNat(string $t38UdptlNat): PsEndpointInterface
    {
        Assertion::choice(
            $t38UdptlNat,
            [
                PsEndpointInterface::T38UDPTLNAT_YES,
                PsEndpointInterface::T38UDPTLNAT_NO,
            ],
            't38UdptlNatvalue "%s" is not an element of the valid values: %s'
        );

        $this->t38UdptlNat = $t38UdptlNat;

        return $this;
    }

    /**
     * Get t38UdptlNat
     *
     * @return string
     */
    public function getT38UdptlNat(): string
    {
        return $this->t38UdptlNat;
    }

    /**
     * Set terminal
     *
     * @param TerminalInterface | null
     *
     * @return static
     */
    public function setTerminal(?TerminalInterface $terminal = null): PsEndpointInterface
    {
        $this->terminal = $terminal;

        return $this;
    }

    /**
     * Get terminal
     *
     * @return TerminalInterface | null
     */
    public function getTerminal(): ?TerminalInterface
    {
        return $this->terminal;
    }

    /**
     * Set friend
     *
     * @param FriendInterface | null
     *
     * @return static
     */
    public function setFriend(?FriendInterface $friend = null): PsEndpointInterface
    {
        $this->friend = $friend;

        return $this;
    }

    /**
     * Get friend
     *
     * @return FriendInterface | null
     */
    public function getFriend(): ?FriendInterface
    {
        return $this->friend;
    }

    /**
     * Set residentialDevice
     *
     * @param ResidentialDeviceInterface | null
     *
     * @return static
     */
    public function setResidentialDevice(?ResidentialDeviceInterface $residentialDevice = null): PsEndpointInterface
    {
        $this->residentialDevice = $residentialDevice;

        return $this;
    }

    /**
     * Get residentialDevice
     *
     * @return ResidentialDeviceInterface | null
     */
    public function getResidentialDevice(): ?ResidentialDeviceInterface
    {
        return $this->residentialDevice;
    }

    /**
     * Set retailAccount
     *
     * @param RetailAccountInterface | null
     *
     * @return static
     */
    public function setRetailAccount(?RetailAccountInterface $retailAccount = null): PsEndpointInterface
    {
        $this->retailAccount = $retailAccount;

        return $this;
    }

    /**
     * Get retailAccount
     *
     * @return RetailAccountInterface | null
     */
    public function getRetailAccount(): ?RetailAccountInterface
    {
        return $this->retailAccount;
    }

}
