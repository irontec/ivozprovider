<?php

namespace Ivoz\Ast\Domain\Model\PsEndpoint;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Terminal\TerminalDto;
use Ivoz\Provider\Domain\Model\Friend\FriendDto;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceDto;
use Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountDto;

/**
* PsEndpointDtoAbstract
* @codeCoverageIgnore
*/
abstract class PsEndpointDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string|null
     */
    private $sorceryId = null;

    /**
     * @var string|null
     */
    private $fromDomain = null;

    /**
     * @var string|null
     */
    private $aors = null;

    /**
     * @var string|null
     */
    private $callerid = null;

    /**
     * @var string|null
     */
    private $context = 'users';

    /**
     * @var string|null
     */
    private $disallow = 'all';

    /**
     * @var string|null
     */
    private $allow = 'all';

    /**
     * @var string|null
     */
    private $directMedia = 'yes';

    /**
     * @var string|null
     */
    private $directMediaMethod = 'update';

    /**
     * @var string|null
     */
    private $mailboxes = null;

    /**
     * @var string|null
     */
    private $namedPickupGroup = null;

    /**
     * @var string|null
     */
    private $subscribeContext = null;

    /**
     * @var string|null
     */
    private $hintExtension = null;

    /**
     * @var string|null
     */
    private $sendDiversion = 'yes';

    /**
     * @var string|null
     */
    private $sendPai = 'yes';

    /**
     * @var string|null
     */
    private $oneHundredRel = 'no';

    /**
     * @var string|null
     */
    private $outboundProxy = null;

    /**
     * @var string|null
     */
    private $trustIdInbound = null;

    /**
     * @var string|null
     */
    private $t38Udptl = 'no';

    /**
     * @var string|null
     */
    private $t38UdptlEc = 'redundancy';

    /**
     * @var int|null
     */
    private $t38UdptlMaxdatagram = 1440;

    /**
     * @var string|null
     */
    private $t38UdptlNat = 'no';

    /**
     * @var int|null
     */
    private $rtpTimeout = 60;

    /**
     * @var int|null
     */
    private $rtpTimeoutHold = 600;

    /**
     * @var int|null
     */
    private $id = null;

    /**
     * @var TerminalDto | null
     */
    private $terminal = null;

    /**
     * @var FriendDto | null
     */
    private $friend = null;

    /**
     * @var ResidentialDeviceDto | null
     */
    private $residentialDevice = null;

    /**
     * @var RetailAccountDto | null
     */
    private $retailAccount = null;

    /**
     * @param string|int|null $id
     */
    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
    * @inheritdoc
    */
    public static function getPropertyMap(string $context = '', string $role = null): array
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return ['id' => 'id'];
        }

        return [
            'sorceryId' => 'sorceryId',
            'fromDomain' => 'fromDomain',
            'aors' => 'aors',
            'callerid' => 'callerid',
            'context' => 'context',
            'disallow' => 'disallow',
            'allow' => 'allow',
            'directMedia' => 'directMedia',
            'directMediaMethod' => 'directMediaMethod',
            'mailboxes' => 'mailboxes',
            'namedPickupGroup' => 'namedPickupGroup',
            'subscribeContext' => 'subscribeContext',
            'hintExtension' => 'hintExtension',
            'sendDiversion' => 'sendDiversion',
            'sendPai' => 'sendPai',
            'oneHundredRel' => 'oneHundredRel',
            'outboundProxy' => 'outboundProxy',
            'trustIdInbound' => 'trustIdInbound',
            't38Udptl' => 't38Udptl',
            't38UdptlEc' => 't38UdptlEc',
            't38UdptlMaxdatagram' => 't38UdptlMaxdatagram',
            't38UdptlNat' => 't38UdptlNat',
            'rtpTimeout' => 'rtpTimeout',
            'rtpTimeoutHold' => 'rtpTimeoutHold',
            'id' => 'id',
            'terminalId' => 'terminal',
            'friendId' => 'friend',
            'residentialDeviceId' => 'residentialDevice',
            'retailAccountId' => 'retailAccount'
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(bool $hideSensitiveData = false): array
    {
        $response = [
            'sorceryId' => $this->getSorceryId(),
            'fromDomain' => $this->getFromDomain(),
            'aors' => $this->getAors(),
            'callerid' => $this->getCallerid(),
            'context' => $this->getContext(),
            'disallow' => $this->getDisallow(),
            'allow' => $this->getAllow(),
            'directMedia' => $this->getDirectMedia(),
            'directMediaMethod' => $this->getDirectMediaMethod(),
            'mailboxes' => $this->getMailboxes(),
            'namedPickupGroup' => $this->getNamedPickupGroup(),
            'subscribeContext' => $this->getSubscribeContext(),
            'hintExtension' => $this->getHintExtension(),
            'sendDiversion' => $this->getSendDiversion(),
            'sendPai' => $this->getSendPai(),
            'oneHundredRel' => $this->getOneHundredRel(),
            'outboundProxy' => $this->getOutboundProxy(),
            'trustIdInbound' => $this->getTrustIdInbound(),
            't38Udptl' => $this->getT38Udptl(),
            't38UdptlEc' => $this->getT38UdptlEc(),
            't38UdptlMaxdatagram' => $this->getT38UdptlMaxdatagram(),
            't38UdptlNat' => $this->getT38UdptlNat(),
            'rtpTimeout' => $this->getRtpTimeout(),
            'rtpTimeoutHold' => $this->getRtpTimeoutHold(),
            'id' => $this->getId(),
            'terminal' => $this->getTerminal(),
            'friend' => $this->getFriend(),
            'residentialDevice' => $this->getResidentialDevice(),
            'retailAccount' => $this->getRetailAccount()
        ];

        if (!$hideSensitiveData) {
            return $response;
        }

        foreach ($this->sensitiveFields as $sensitiveField) {
            if (!array_key_exists($sensitiveField, $response)) {
                throw new \Exception($sensitiveField . ' field was not found');
            }
            $response[$sensitiveField] = '*****';
        }

        return $response;
    }

    public function setSorceryId(string $sorceryId): static
    {
        $this->sorceryId = $sorceryId;

        return $this;
    }

    public function getSorceryId(): ?string
    {
        return $this->sorceryId;
    }

    public function setFromDomain(?string $fromDomain): static
    {
        $this->fromDomain = $fromDomain;

        return $this;
    }

    public function getFromDomain(): ?string
    {
        return $this->fromDomain;
    }

    public function setAors(?string $aors): static
    {
        $this->aors = $aors;

        return $this;
    }

    public function getAors(): ?string
    {
        return $this->aors;
    }

    public function setCallerid(?string $callerid): static
    {
        $this->callerid = $callerid;

        return $this;
    }

    public function getCallerid(): ?string
    {
        return $this->callerid;
    }

    public function setContext(string $context): static
    {
        $this->context = $context;

        return $this;
    }

    public function getContext(): ?string
    {
        return $this->context;
    }

    public function setDisallow(string $disallow): static
    {
        $this->disallow = $disallow;

        return $this;
    }

    public function getDisallow(): ?string
    {
        return $this->disallow;
    }

    public function setAllow(string $allow): static
    {
        $this->allow = $allow;

        return $this;
    }

    public function getAllow(): ?string
    {
        return $this->allow;
    }

    public function setDirectMedia(?string $directMedia): static
    {
        $this->directMedia = $directMedia;

        return $this;
    }

    public function getDirectMedia(): ?string
    {
        return $this->directMedia;
    }

    public function setDirectMediaMethod(?string $directMediaMethod): static
    {
        $this->directMediaMethod = $directMediaMethod;

        return $this;
    }

    public function getDirectMediaMethod(): ?string
    {
        return $this->directMediaMethod;
    }

    public function setMailboxes(?string $mailboxes): static
    {
        $this->mailboxes = $mailboxes;

        return $this;
    }

    public function getMailboxes(): ?string
    {
        return $this->mailboxes;
    }

    public function setNamedPickupGroup(?string $namedPickupGroup): static
    {
        $this->namedPickupGroup = $namedPickupGroup;

        return $this;
    }

    public function getNamedPickupGroup(): ?string
    {
        return $this->namedPickupGroup;
    }

    public function setSubscribeContext(?string $subscribeContext): static
    {
        $this->subscribeContext = $subscribeContext;

        return $this;
    }

    public function getSubscribeContext(): ?string
    {
        return $this->subscribeContext;
    }

    public function setHintExtension(?string $hintExtension): static
    {
        $this->hintExtension = $hintExtension;

        return $this;
    }

    public function getHintExtension(): ?string
    {
        return $this->hintExtension;
    }

    public function setSendDiversion(?string $sendDiversion): static
    {
        $this->sendDiversion = $sendDiversion;

        return $this;
    }

    public function getSendDiversion(): ?string
    {
        return $this->sendDiversion;
    }

    public function setSendPai(?string $sendPai): static
    {
        $this->sendPai = $sendPai;

        return $this;
    }

    public function getSendPai(): ?string
    {
        return $this->sendPai;
    }

    public function setOneHundredRel(string $oneHundredRel): static
    {
        $this->oneHundredRel = $oneHundredRel;

        return $this;
    }

    public function getOneHundredRel(): ?string
    {
        return $this->oneHundredRel;
    }

    public function setOutboundProxy(?string $outboundProxy): static
    {
        $this->outboundProxy = $outboundProxy;

        return $this;
    }

    public function getOutboundProxy(): ?string
    {
        return $this->outboundProxy;
    }

    public function setTrustIdInbound(?string $trustIdInbound): static
    {
        $this->trustIdInbound = $trustIdInbound;

        return $this;
    }

    public function getTrustIdInbound(): ?string
    {
        return $this->trustIdInbound;
    }

    public function setT38Udptl(string $t38Udptl): static
    {
        $this->t38Udptl = $t38Udptl;

        return $this;
    }

    public function getT38Udptl(): ?string
    {
        return $this->t38Udptl;
    }

    public function setT38UdptlEc(string $t38UdptlEc): static
    {
        $this->t38UdptlEc = $t38UdptlEc;

        return $this;
    }

    public function getT38UdptlEc(): ?string
    {
        return $this->t38UdptlEc;
    }

    public function setT38UdptlMaxdatagram(int $t38UdptlMaxdatagram): static
    {
        $this->t38UdptlMaxdatagram = $t38UdptlMaxdatagram;

        return $this;
    }

    public function getT38UdptlMaxdatagram(): ?int
    {
        return $this->t38UdptlMaxdatagram;
    }

    public function setT38UdptlNat(string $t38UdptlNat): static
    {
        $this->t38UdptlNat = $t38UdptlNat;

        return $this;
    }

    public function getT38UdptlNat(): ?string
    {
        return $this->t38UdptlNat;
    }

    public function setRtpTimeout(int $rtpTimeout): static
    {
        $this->rtpTimeout = $rtpTimeout;

        return $this;
    }

    public function getRtpTimeout(): ?int
    {
        return $this->rtpTimeout;
    }

    public function setRtpTimeoutHold(int $rtpTimeoutHold): static
    {
        $this->rtpTimeoutHold = $rtpTimeoutHold;

        return $this;
    }

    public function getRtpTimeoutHold(): ?int
    {
        return $this->rtpTimeoutHold;
    }

    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setTerminal(?TerminalDto $terminal): static
    {
        $this->terminal = $terminal;

        return $this;
    }

    public function getTerminal(): ?TerminalDto
    {
        return $this->terminal;
    }

    public function setTerminalId($id): static
    {
        $value = !is_null($id)
            ? new TerminalDto($id)
            : null;

        return $this->setTerminal($value);
    }

    public function getTerminalId()
    {
        if ($dto = $this->getTerminal()) {
            return $dto->getId();
        }

        return null;
    }

    public function setFriend(?FriendDto $friend): static
    {
        $this->friend = $friend;

        return $this;
    }

    public function getFriend(): ?FriendDto
    {
        return $this->friend;
    }

    public function setFriendId($id): static
    {
        $value = !is_null($id)
            ? new FriendDto($id)
            : null;

        return $this->setFriend($value);
    }

    public function getFriendId()
    {
        if ($dto = $this->getFriend()) {
            return $dto->getId();
        }

        return null;
    }

    public function setResidentialDevice(?ResidentialDeviceDto $residentialDevice): static
    {
        $this->residentialDevice = $residentialDevice;

        return $this;
    }

    public function getResidentialDevice(): ?ResidentialDeviceDto
    {
        return $this->residentialDevice;
    }

    public function setResidentialDeviceId($id): static
    {
        $value = !is_null($id)
            ? new ResidentialDeviceDto($id)
            : null;

        return $this->setResidentialDevice($value);
    }

    public function getResidentialDeviceId()
    {
        if ($dto = $this->getResidentialDevice()) {
            return $dto->getId();
        }

        return null;
    }

    public function setRetailAccount(?RetailAccountDto $retailAccount): static
    {
        $this->retailAccount = $retailAccount;

        return $this;
    }

    public function getRetailAccount(): ?RetailAccountDto
    {
        return $this->retailAccount;
    }

    public function setRetailAccountId($id): static
    {
        $value = !is_null($id)
            ? new RetailAccountDto($id)
            : null;

        return $this->setRetailAccount($value);
    }

    public function getRetailAccountId()
    {
        if ($dto = $this->getRetailAccount()) {
            return $dto->getId();
        }

        return null;
    }
}
