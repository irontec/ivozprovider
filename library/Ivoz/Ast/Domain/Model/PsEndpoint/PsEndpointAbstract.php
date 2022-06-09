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
     * @var string
     * column: sorcery_id
     */
    protected $sorceryId;

    /**
     * @var ?string
     * column: from_domain
     */
    protected $fromDomain = null;

    /**
     * @var ?string
     */
    protected $aors = null;

    /**
     * @var ?string
     */
    protected $callerid = null;

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
     * @var ?string
     * column: direct_media
     * comment: enum:yes|no
     */
    protected $directMedia = 'yes';

    /**
     * @var ?string
     * column: direct_media_method
     * comment: enum:update|invite|reinvite
     */
    protected $directMediaMethod = 'update';

    /**
     * @var ?string
     */
    protected $mailboxes = null;

    /**
     * @var ?string
     * column: named_pickup_group
     */
    protected $namedPickupGroup = null;

    /**
     * @var ?string
     * column: subscribe_context
     */
    protected $subscribeContext = null;

    /**
     * @var ?string
     * column: hint_extension
     */
    protected $hintExtension = null;

    /**
     * @var ?string
     * column: send_diversion
     * comment: enum:yes|no
     */
    protected $sendDiversion = 'yes';

    /**
     * @var ?string
     * column: send_pai
     * comment: enum:yes|no
     */
    protected $sendPai = 'yes';

    /**
     * @var string
     * column: 100rel
     * comment: enum:no|required|yes
     */
    protected $oneHundredRel = 'no';

    /**
     * @var ?string
     * column: outbound_proxy
     */
    protected $outboundProxy = null;

    /**
     * @var ?string
     * column: trust_id_inbound
     * comment: enum:no|yes
     */
    protected $trustIdInbound = null;

    /**
     * @var string
     * column: t38_udptl
     * comment: enum:yes|no
     */
    protected $t38Udptl = 'no';

    /**
     * @var string
     * column: t38_udptl_ec
     * comment: enum:none|fec|redundancy
     */
    protected $t38UdptlEc = 'redundancy';

    /**
     * @var int
     * column: t38_udptl_maxdatagram
     */
    protected $t38UdptlMaxdatagram = 1440;

    /**
     * @var string
     * column: t38_udptl_nat
     * comment: enum:yes|no
     */
    protected $t38UdptlNat = 'no';

    /**
     * @var ?TerminalInterface
     * inversedBy psEndpoint
     */
    protected $terminal = null;

    /**
     * @var ?FriendInterface
     * inversedBy psEndpoint
     */
    protected $friend = null;

    /**
     * @var ?ResidentialDeviceInterface
     * inversedBy psEndpoint
     */
    protected $residentialDevice = null;

    /**
     * @var ?RetailAccountInterface
     * inversedBy psEndpoint
     */
    protected $retailAccount = null;

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

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "PsEndpoint",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): PsEndpointDto
    {
        return new PsEndpointDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|PsEndpointInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?PsEndpointDto
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

        $dto = $entity->toDto($depth - 1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param PsEndpointDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, PsEndpointDto::class);
        $sorceryId = $dto->getSorceryId();
        Assertion::notNull($sorceryId, 'getSorceryId value is null, but non null value was expected.');
        $context = $dto->getContext();
        Assertion::notNull($context, 'getContext value is null, but non null value was expected.');
        $disallow = $dto->getDisallow();
        Assertion::notNull($disallow, 'getDisallow value is null, but non null value was expected.');
        $allow = $dto->getAllow();
        Assertion::notNull($allow, 'getAllow value is null, but non null value was expected.');
        $oneHundredRel = $dto->getOneHundredRel();
        Assertion::notNull($oneHundredRel, 'getOneHundredRel value is null, but non null value was expected.');
        $t38Udptl = $dto->getT38Udptl();
        Assertion::notNull($t38Udptl, 'getT38Udptl value is null, but non null value was expected.');
        $t38UdptlEc = $dto->getT38UdptlEc();
        Assertion::notNull($t38UdptlEc, 'getT38UdptlEc value is null, but non null value was expected.');
        $t38UdptlMaxdatagram = $dto->getT38UdptlMaxdatagram();
        Assertion::notNull($t38UdptlMaxdatagram, 'getT38UdptlMaxdatagram value is null, but non null value was expected.');
        $t38UdptlNat = $dto->getT38UdptlNat();
        Assertion::notNull($t38UdptlNat, 'getT38UdptlNat value is null, but non null value was expected.');

        $self = new static(
            $sorceryId,
            $context,
            $disallow,
            $allow,
            $oneHundredRel,
            $t38Udptl,
            $t38UdptlEc,
            $t38UdptlMaxdatagram,
            $t38UdptlNat
        );

        $self
            ->setFromDomain($dto->getFromDomain())
            ->setAors($dto->getAors())
            ->setCallerid($dto->getCallerid())
            ->setDirectMedia($dto->getDirectMedia())
            ->setDirectMediaMethod($dto->getDirectMediaMethod())
            ->setMailboxes($dto->getMailboxes())
            ->setNamedPickupGroup($dto->getNamedPickupGroup())
            ->setSubscribeContext($dto->getSubscribeContext())
            ->setHintExtension($dto->getHintExtension())
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
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, PsEndpointDto::class);

        $sorceryId = $dto->getSorceryId();
        Assertion::notNull($sorceryId, 'getSorceryId value is null, but non null value was expected.');
        $context = $dto->getContext();
        Assertion::notNull($context, 'getContext value is null, but non null value was expected.');
        $disallow = $dto->getDisallow();
        Assertion::notNull($disallow, 'getDisallow value is null, but non null value was expected.');
        $allow = $dto->getAllow();
        Assertion::notNull($allow, 'getAllow value is null, but non null value was expected.');
        $oneHundredRel = $dto->getOneHundredRel();
        Assertion::notNull($oneHundredRel, 'getOneHundredRel value is null, but non null value was expected.');
        $t38Udptl = $dto->getT38Udptl();
        Assertion::notNull($t38Udptl, 'getT38Udptl value is null, but non null value was expected.');
        $t38UdptlEc = $dto->getT38UdptlEc();
        Assertion::notNull($t38UdptlEc, 'getT38UdptlEc value is null, but non null value was expected.');
        $t38UdptlMaxdatagram = $dto->getT38UdptlMaxdatagram();
        Assertion::notNull($t38UdptlMaxdatagram, 'getT38UdptlMaxdatagram value is null, but non null value was expected.');
        $t38UdptlNat = $dto->getT38UdptlNat();
        Assertion::notNull($t38UdptlNat, 'getT38UdptlNat value is null, but non null value was expected.');

        $this
            ->setSorceryId($sorceryId)
            ->setFromDomain($dto->getFromDomain())
            ->setAors($dto->getAors())
            ->setCallerid($dto->getCallerid())
            ->setContext($context)
            ->setDisallow($disallow)
            ->setAllow($allow)
            ->setDirectMedia($dto->getDirectMedia())
            ->setDirectMediaMethod($dto->getDirectMediaMethod())
            ->setMailboxes($dto->getMailboxes())
            ->setNamedPickupGroup($dto->getNamedPickupGroup())
            ->setSubscribeContext($dto->getSubscribeContext())
            ->setHintExtension($dto->getHintExtension())
            ->setSendDiversion($dto->getSendDiversion())
            ->setSendPai($dto->getSendPai())
            ->setOneHundredRel($oneHundredRel)
            ->setOutboundProxy($dto->getOutboundProxy())
            ->setTrustIdInbound($dto->getTrustIdInbound())
            ->setT38Udptl($t38Udptl)
            ->setT38UdptlEc($t38UdptlEc)
            ->setT38UdptlMaxdatagram($t38UdptlMaxdatagram)
            ->setT38UdptlNat($t38UdptlNat)
            ->setTerminal($fkTransformer->transform($dto->getTerminal()))
            ->setFriend($fkTransformer->transform($dto->getFriend()))
            ->setResidentialDevice($fkTransformer->transform($dto->getResidentialDevice()))
            ->setRetailAccount($fkTransformer->transform($dto->getRetailAccount()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): PsEndpointDto
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
            ->setSubscribeContext(self::getSubscribeContext())
            ->setHintExtension(self::getHintExtension())
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
     * @return array<string, mixed>
     */
    protected function __toArray(): array
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
            'subscribe_context' => self::getSubscribeContext(),
            'hint_extension' => self::getHintExtension(),
            'send_diversion' => self::getSendDiversion(),
            'send_pai' => self::getSendPai(),
            '100rel' => self::getOneHundredRel(),
            'outbound_proxy' => self::getOutboundProxy(),
            'trust_id_inbound' => self::getTrustIdInbound(),
            't38_udptl' => self::getT38Udptl(),
            't38_udptl_ec' => self::getT38UdptlEc(),
            't38_udptl_maxdatagram' => self::getT38UdptlMaxdatagram(),
            't38_udptl_nat' => self::getT38UdptlNat(),
            'terminalId' => self::getTerminal()?->getId(),
            'friendId' => self::getFriend()?->getId(),
            'residentialDeviceId' => self::getResidentialDevice()?->getId(),
            'retailAccountId' => self::getRetailAccount()?->getId()
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
        if (!is_null($directMedia)) {
            Assertion::maxLength($directMedia, 25, 'directMedia value "%s" is too long, it should have no more than %d characters, but has %d characters.');
            Assertion::choice(
                $directMedia,
                [
                    PsEndpointInterface::DIRECTMEDIA_YES,
                    PsEndpointInterface::DIRECTMEDIA_NO,
                ],
                'directMediavalue "%s" is not an element of the valid values: %s'
            );
        }

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
            Assertion::maxLength($directMediaMethod, 25, 'directMediaMethod value "%s" is too long, it should have no more than %d characters, but has %d characters.');
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

    protected function setSubscribeContext(?string $subscribeContext = null): static
    {
        if (!is_null($subscribeContext)) {
            Assertion::maxLength($subscribeContext, 40, 'subscribeContext value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->subscribeContext = $subscribeContext;

        return $this;
    }

    public function getSubscribeContext(): ?string
    {
        return $this->subscribeContext;
    }

    protected function setHintExtension(?string $hintExtension = null): static
    {
        if (!is_null($hintExtension)) {
            Assertion::maxLength($hintExtension, 10, 'hintExtension value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->hintExtension = $hintExtension;

        return $this;
    }

    public function getHintExtension(): ?string
    {
        return $this->hintExtension;
    }

    protected function setSendDiversion(?string $sendDiversion = null): static
    {
        if (!is_null($sendDiversion)) {
            Assertion::maxLength($sendDiversion, 25, 'sendDiversion value "%s" is too long, it should have no more than %d characters, but has %d characters.');
            Assertion::choice(
                $sendDiversion,
                [
                    PsEndpointInterface::SENDDIVERSION_YES,
                    PsEndpointInterface::SENDDIVERSION_NO,
                ],
                'sendDiversionvalue "%s" is not an element of the valid values: %s'
            );
        }

        $this->sendDiversion = $sendDiversion;

        return $this;
    }

    public function getSendDiversion(): ?string
    {
        return $this->sendDiversion;
    }

    protected function setSendPai(?string $sendPai = null): static
    {
        if (!is_null($sendPai)) {
            Assertion::maxLength($sendPai, 25, 'sendPai value "%s" is too long, it should have no more than %d characters, but has %d characters.');
            Assertion::choice(
                $sendPai,
                [
                    PsEndpointInterface::SENDPAI_YES,
                    PsEndpointInterface::SENDPAI_NO,
                ],
                'sendPaivalue "%s" is not an element of the valid values: %s'
            );
        }

        $this->sendPai = $sendPai;

        return $this;
    }

    public function getSendPai(): ?string
    {
        return $this->sendPai;
    }

    protected function setOneHundredRel(string $oneHundredRel): static
    {
        Assertion::maxLength($oneHundredRel, 25, 'oneHundredRel value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        Assertion::choice(
            $oneHundredRel,
            [
                PsEndpointInterface::ONEHUNDREDREL_NO,
                PsEndpointInterface::ONEHUNDREDREL_REQUIRED,
                PsEndpointInterface::ONEHUNDREDREL_YES,
            ],
            'oneHundredRelvalue "%s" is not an element of the valid values: %s'
        );

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
        if (!is_null($trustIdInbound)) {
            Assertion::maxLength($trustIdInbound, 25, 'trustIdInbound value "%s" is too long, it should have no more than %d characters, but has %d characters.');
            Assertion::choice(
                $trustIdInbound,
                [
                    PsEndpointInterface::TRUSTIDINBOUND_NO,
                    PsEndpointInterface::TRUSTIDINBOUND_YES,
                ],
                'trustIdInboundvalue "%s" is not an element of the valid values: %s'
            );
        }

        $this->trustIdInbound = $trustIdInbound;

        return $this;
    }

    public function getTrustIdInbound(): ?string
    {
        return $this->trustIdInbound;
    }

    protected function setT38Udptl(string $t38Udptl): static
    {
        Assertion::maxLength($t38Udptl, 25, 't38Udptl value "%s" is too long, it should have no more than %d characters, but has %d characters.');
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
        Assertion::maxLength($t38UdptlEc, 25, 't38UdptlEc value "%s" is too long, it should have no more than %d characters, but has %d characters.');
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
        Assertion::maxLength($t38UdptlNat, 25, 't38UdptlNat value "%s" is too long, it should have no more than %d characters, but has %d characters.');
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

        return $this;
    }

    public function getTerminal(): ?TerminalInterface
    {
        return $this->terminal;
    }

    public function setFriend(?FriendInterface $friend = null): static
    {
        $this->friend = $friend;

        return $this;
    }

    public function getFriend(): ?FriendInterface
    {
        return $this->friend;
    }

    public function setResidentialDevice(?ResidentialDeviceInterface $residentialDevice = null): static
    {
        $this->residentialDevice = $residentialDevice;

        return $this;
    }

    public function getResidentialDevice(): ?ResidentialDeviceInterface
    {
        return $this->residentialDevice;
    }

    public function setRetailAccount(?RetailAccountInterface $retailAccount = null): static
    {
        $this->retailAccount = $retailAccount;

        return $this;
    }

    public function getRetailAccount(): ?RetailAccountInterface
    {
        return $this->retailAccount;
    }
}
