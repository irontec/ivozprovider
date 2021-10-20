<?php

declare(strict_types=1);

namespace Ivoz\Ast\Domain\Model\PsEndpoint;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
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
     */
    protected $sorceryId;

    /**
     * column: from_domain
     */
    protected $fromDomain;

    protected $aors;

    protected $callerid;

    protected $context = 'users';

    protected $disallow = 'all';

    protected $allow = 'all';

    /**
     * column: direct_media
     */
    protected $directMedia = 'yes';

    /**
     * column: direct_media_method
     * comment: enum:update|invite|reinvite
     */
    protected $directMediaMethod = 'update';

    protected $mailboxes;

    /**
     * column: named_pickup_group
     */
    protected $namedPickupGroup;

    /**
     * column: send_diversion
     */
    protected $sendDiversion = 'yes';

    /**
     * column: send_pai
     */
    protected $sendPai = 'yes';

    /**
     * column: 100rel
     */
    protected $oneHundredRel = 'no';

    /**
     * column: outbound_proxy
     */
    protected $outboundProxy;

    /**
     * column: trust_id_inbound
     */
    protected $trustIdInbound;

    /**
     * column: t38_udptl
     * comment: enum:yes|no
     */
    protected $t38Udptl = 'no';

    /**
     * column: t38_udptl_ec
     * comment: enum:none|fec|redundancy
     */
    protected $t38UdptlEc = 'redundancy';

    /**
     * column: t38_udptl_maxdatagram
     */
    protected $t38UdptlMaxdatagram = 1440;

    /**
     * column: t38_udptl_nat
     * comment: enum:yes|no
     */
    protected $t38UdptlNat = 'no';

    /**
     * @var TerminalInterface | null
     * inversedBy psEndpoint
     */
    protected $terminal;

    /**
     * @var FriendInterface | null
     * inversedBy psEndpoint
     */
    protected $friend;

    /**
     * @var ResidentialDeviceInterface | null
     * inversedBy psEndpoint
     */
    protected $residentialDevice;

    /**
     * @var RetailAccountInterface | null
     * inversedBy psEndpoint
     */
    protected $retailAccount;

    /**
     * Constructor
     */
    protected function __construct(
        string $sorceryId,
        string $context,
        string $disallow,
        string $allow,
        string $oneHundredRel,
        string $t38Udptl,
        string $t38UdptlEc,
        int $t38UdptlMaxdatagram,
        string $t38UdptlNat
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
     * @param mixed $id
     */
    public static function createDto($id = null): PsEndpointDto
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
        $dto = $entity->toDto($depth - 1);

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
     */
    public function toDto($depth = 0): PsEndpointDto
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

    protected function setSorceryId(string $sorceryId): static
    {
        Assertion::maxLength($sorceryId, 40, 'sorceryId value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->sorceryId = $sorceryId;

        return $this;
    }

    public function getSorceryId(): string
    {
        return $this->sorceryId;
    }

    protected function setFromDomain(?string $fromDomain = null): static
    {
        if (!is_null($fromDomain)) {
            Assertion::maxLength($fromDomain, 190, 'fromDomain value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->fromDomain = $fromDomain;

        return $this;
    }

    public function getFromDomain(): ?string
    {
        return $this->fromDomain;
    }

    protected function setAors(?string $aors = null): static
    {
        if (!is_null($aors)) {
            Assertion::maxLength($aors, 200, 'aors value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->aors = $aors;

        return $this;
    }

    public function getAors(): ?string
    {
        return $this->aors;
    }

    protected function setCallerid(?string $callerid = null): static
    {
        if (!is_null($callerid)) {
            Assertion::maxLength($callerid, 100, 'callerid value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->callerid = $callerid;

        return $this;
    }

    public function getCallerid(): ?string
    {
        return $this->callerid;
    }

    protected function setContext(string $context): static
    {
        Assertion::maxLength($context, 40, 'context value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->context = $context;

        return $this;
    }

    public function getContext(): string
    {
        return $this->context;
    }

    protected function setDisallow(string $disallow): static
    {
        Assertion::maxLength($disallow, 200, 'disallow value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->disallow = $disallow;

        return $this;
    }

    public function getDisallow(): string
    {
        return $this->disallow;
    }

    protected function setAllow(string $allow): static
    {
        Assertion::maxLength($allow, 200, 'allow value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->allow = $allow;

        return $this;
    }

    public function getAllow(): string
    {
        return $this->allow;
    }

    protected function setDirectMedia(?string $directMedia = null): static
    {
        $this->directMedia = $directMedia;

        return $this;
    }

    public function getDirectMedia(): ?string
    {
        return $this->directMedia;
    }

    protected function setDirectMediaMethod(?string $directMediaMethod = null): static
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

    public function getDirectMediaMethod(): ?string
    {
        return $this->directMediaMethod;
    }

    protected function setMailboxes(?string $mailboxes = null): static
    {
        if (!is_null($mailboxes)) {
            Assertion::maxLength($mailboxes, 100, 'mailboxes value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->mailboxes = $mailboxes;

        return $this;
    }

    public function getMailboxes(): ?string
    {
        return $this->mailboxes;
    }

    protected function setNamedPickupGroup(?string $namedPickupGroup = null): static
    {
        if (!is_null($namedPickupGroup)) {
            Assertion::maxLength($namedPickupGroup, 255, 'namedPickupGroup value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->namedPickupGroup = $namedPickupGroup;

        return $this;
    }

    public function getNamedPickupGroup(): ?string
    {
        return $this->namedPickupGroup;
    }

    protected function setSendDiversion(?string $sendDiversion = null): static
    {
        $this->sendDiversion = $sendDiversion;

        return $this;
    }

    public function getSendDiversion(): ?string
    {
        return $this->sendDiversion;
    }

    protected function setSendPai(?string $sendPai = null): static
    {
        $this->sendPai = $sendPai;

        return $this;
    }

    public function getSendPai(): ?string
    {
        return $this->sendPai;
    }

    protected function setOneHundredRel(string $oneHundredRel): static
    {
        $this->oneHundredRel = $oneHundredRel;

        return $this;
    }

    public function getOneHundredRel(): string
    {
        return $this->oneHundredRel;
    }

    protected function setOutboundProxy(?string $outboundProxy = null): static
    {
        if (!is_null($outboundProxy)) {
            Assertion::maxLength($outboundProxy, 256, 'outboundProxy value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->outboundProxy = $outboundProxy;

        return $this;
    }

    public function getOutboundProxy(): ?string
    {
        return $this->outboundProxy;
    }

    protected function setTrustIdInbound(?string $trustIdInbound = null): static
    {
        $this->trustIdInbound = $trustIdInbound;

        return $this;
    }

    public function getTrustIdInbound(): ?string
    {
        return $this->trustIdInbound;
    }

    protected function setT38Udptl(string $t38Udptl): static
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

    public function getT38Udptl(): string
    {
        return $this->t38Udptl;
    }

    protected function setT38UdptlEc(string $t38UdptlEc): static
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

    public function getT38UdptlEc(): string
    {
        return $this->t38UdptlEc;
    }

    protected function setT38UdptlMaxdatagram(int $t38UdptlMaxdatagram): static
    {
        Assertion::greaterOrEqualThan($t38UdptlMaxdatagram, 0, 't38UdptlMaxdatagram provided "%s" is not greater or equal than "%s".');

        $this->t38UdptlMaxdatagram = $t38UdptlMaxdatagram;

        return $this;
    }

    public function getT38UdptlMaxdatagram(): int
    {
        return $this->t38UdptlMaxdatagram;
    }

    protected function setT38UdptlNat(string $t38UdptlNat): static
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

    public function getT38UdptlNat(): string
    {
        return $this->t38UdptlNat;
    }

    public function setTerminal(?TerminalInterface $terminal = null): static
    {
        $this->terminal = $terminal;

        /** @var  $this */
        return $this;
    }

    public function getTerminal(): ?TerminalInterface
    {
        return $this->terminal;
    }

    public function setFriend(?FriendInterface $friend = null): static
    {
        $this->friend = $friend;

        /** @var  $this */
        return $this;
    }

    public function getFriend(): ?FriendInterface
    {
        return $this->friend;
    }

    public function setResidentialDevice(?ResidentialDeviceInterface $residentialDevice = null): static
    {
        $this->residentialDevice = $residentialDevice;

        /** @var  $this */
        return $this;
    }

    public function getResidentialDevice(): ?ResidentialDeviceInterface
    {
        return $this->residentialDevice;
    }

    public function setRetailAccount(?RetailAccountInterface $retailAccount = null): static
    {
        $this->retailAccount = $retailAccount;

        /** @var  $this */
        return $this;
    }

    public function getRetailAccount(): ?RetailAccountInterface
    {
        return $this->retailAccount;
    }
}
