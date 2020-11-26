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
     * @var string
     */
    private $sorceryId;

    /**
     * @var string | null
     */
    private $fromDomain;

    /**
     * @var string | null
     */
    private $aors;

    /**
     * @var string | null
     */
    private $callerid;

    /**
     * @var string
     */
    private $context = 'users';

    /**
     * @var string
     */
    private $disallow = 'all';

    /**
     * @var string
     */
    private $allow = 'all';

    /**
     * @var string | null
     */
    private $directMedia = 'yes';

    /**
     * @var string | null
     */
    private $directMediaMethod = 'update';

    /**
     * @var string | null
     */
    private $mailboxes;

    /**
     * @var string | null
     */
    private $namedPickupGroup;

    /**
     * @var string | null
     */
    private $sendDiversion = 'yes';

    /**
     * @var string | null
     */
    private $sendPai = 'yes';

    /**
     * @var string
     */
    private $oneHundredRel = 'no';

    /**
     * @var string | null
     */
    private $outboundProxy;

    /**
     * @var string | null
     */
    private $trustIdInbound;

    /**
     * @var string
     */
    private $t38Udptl = 'no';

    /**
     * @var string
     */
    private $t38UdptlEc = 'redundancy';

    /**
     * @var int
     */
    private $t38UdptlMaxdatagram = 1440;

    /**
     * @var string
     */
    private $t38UdptlNat = 'no';

    /**
     * @var int
     */
    private $id;

    /**
     * @var TerminalDto | null
     */
    private $terminal;

    /**
     * @var FriendDto | null
     */
    private $friend;

    /**
     * @var ResidentialDeviceDto | null
     */
    private $residentialDevice;

    /**
     * @var RetailAccountDto | null
     */
    private $retailAccount;

    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
    * @inheritdoc
    */
    public static function getPropertyMap(string $context = '', string $role = null)
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
            'sendDiversion' => 'sendDiversion',
            'sendPai' => 'sendPai',
            'oneHundredRel' => 'oneHundredRel',
            'outboundProxy' => 'outboundProxy',
            'trustIdInbound' => 'trustIdInbound',
            't38Udptl' => 't38Udptl',
            't38UdptlEc' => 't38UdptlEc',
            't38UdptlMaxdatagram' => 't38UdptlMaxdatagram',
            't38UdptlNat' => 't38UdptlNat',
            'id' => 'id',
            'terminalId' => 'terminal',
            'friendId' => 'friend',
            'residentialDeviceId' => 'residentialDevice',
            'retailAccountId' => 'retailAccount'
        ];
    }

    /**
    * @return array
    */
    public function toArray($hideSensitiveData = false)
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
            'sendDiversion' => $this->getSendDiversion(),
            'sendPai' => $this->getSendPai(),
            'oneHundredRel' => $this->getOneHundredRel(),
            'outboundProxy' => $this->getOutboundProxy(),
            'trustIdInbound' => $this->getTrustIdInbound(),
            't38Udptl' => $this->getT38Udptl(),
            't38UdptlEc' => $this->getT38UdptlEc(),
            't38UdptlMaxdatagram' => $this->getT38UdptlMaxdatagram(),
            't38UdptlNat' => $this->getT38UdptlNat(),
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

    /**
     * @param string $sorceryId | null
     *
     * @return static
     */
    public function setSorceryId(?string $sorceryId = null): self
    {
        $this->sorceryId = $sorceryId;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getSorceryId(): ?string
    {
        return $this->sorceryId;
    }

    /**
     * @param string $fromDomain | null
     *
     * @return static
     */
    public function setFromDomain(?string $fromDomain = null): self
    {
        $this->fromDomain = $fromDomain;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getFromDomain(): ?string
    {
        return $this->fromDomain;
    }

    /**
     * @param string $aors | null
     *
     * @return static
     */
    public function setAors(?string $aors = null): self
    {
        $this->aors = $aors;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getAors(): ?string
    {
        return $this->aors;
    }

    /**
     * @param string $callerid | null
     *
     * @return static
     */
    public function setCallerid(?string $callerid = null): self
    {
        $this->callerid = $callerid;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getCallerid(): ?string
    {
        return $this->callerid;
    }

    /**
     * @param string $context | null
     *
     * @return static
     */
    public function setContext(?string $context = null): self
    {
        $this->context = $context;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getContext(): ?string
    {
        return $this->context;
    }

    /**
     * @param string $disallow | null
     *
     * @return static
     */
    public function setDisallow(?string $disallow = null): self
    {
        $this->disallow = $disallow;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDisallow(): ?string
    {
        return $this->disallow;
    }

    /**
     * @param string $allow | null
     *
     * @return static
     */
    public function setAllow(?string $allow = null): self
    {
        $this->allow = $allow;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getAllow(): ?string
    {
        return $this->allow;
    }

    /**
     * @param string $directMedia | null
     *
     * @return static
     */
    public function setDirectMedia(?string $directMedia = null): self
    {
        $this->directMedia = $directMedia;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDirectMedia(): ?string
    {
        return $this->directMedia;
    }

    /**
     * @param string $directMediaMethod | null
     *
     * @return static
     */
    public function setDirectMediaMethod(?string $directMediaMethod = null): self
    {
        $this->directMediaMethod = $directMediaMethod;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDirectMediaMethod(): ?string
    {
        return $this->directMediaMethod;
    }

    /**
     * @param string $mailboxes | null
     *
     * @return static
     */
    public function setMailboxes(?string $mailboxes = null): self
    {
        $this->mailboxes = $mailboxes;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getMailboxes(): ?string
    {
        return $this->mailboxes;
    }

    /**
     * @param string $namedPickupGroup | null
     *
     * @return static
     */
    public function setNamedPickupGroup(?string $namedPickupGroup = null): self
    {
        $this->namedPickupGroup = $namedPickupGroup;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getNamedPickupGroup(): ?string
    {
        return $this->namedPickupGroup;
    }

    /**
     * @param string $sendDiversion | null
     *
     * @return static
     */
    public function setSendDiversion(?string $sendDiversion = null): self
    {
        $this->sendDiversion = $sendDiversion;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getSendDiversion(): ?string
    {
        return $this->sendDiversion;
    }

    /**
     * @param string $sendPai | null
     *
     * @return static
     */
    public function setSendPai(?string $sendPai = null): self
    {
        $this->sendPai = $sendPai;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getSendPai(): ?string
    {
        return $this->sendPai;
    }

    /**
     * @param string $oneHundredRel | null
     *
     * @return static
     */
    public function setOneHundredRel(?string $oneHundredRel = null): self
    {
        $this->oneHundredRel = $oneHundredRel;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getOneHundredRel(): ?string
    {
        return $this->oneHundredRel;
    }

    /**
     * @param string $outboundProxy | null
     *
     * @return static
     */
    public function setOutboundProxy(?string $outboundProxy = null): self
    {
        $this->outboundProxy = $outboundProxy;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getOutboundProxy(): ?string
    {
        return $this->outboundProxy;
    }

    /**
     * @param string $trustIdInbound | null
     *
     * @return static
     */
    public function setTrustIdInbound(?string $trustIdInbound = null): self
    {
        $this->trustIdInbound = $trustIdInbound;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getTrustIdInbound(): ?string
    {
        return $this->trustIdInbound;
    }

    /**
     * @param string $t38Udptl | null
     *
     * @return static
     */
    public function setT38Udptl(?string $t38Udptl = null): self
    {
        $this->t38Udptl = $t38Udptl;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getT38Udptl(): ?string
    {
        return $this->t38Udptl;
    }

    /**
     * @param string $t38UdptlEc | null
     *
     * @return static
     */
    public function setT38UdptlEc(?string $t38UdptlEc = null): self
    {
        $this->t38UdptlEc = $t38UdptlEc;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getT38UdptlEc(): ?string
    {
        return $this->t38UdptlEc;
    }

    /**
     * @param int $t38UdptlMaxdatagram | null
     *
     * @return static
     */
    public function setT38UdptlMaxdatagram(?int $t38UdptlMaxdatagram = null): self
    {
        $this->t38UdptlMaxdatagram = $t38UdptlMaxdatagram;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getT38UdptlMaxdatagram(): ?int
    {
        return $this->t38UdptlMaxdatagram;
    }

    /**
     * @param string $t38UdptlNat | null
     *
     * @return static
     */
    public function setT38UdptlNat(?string $t38UdptlNat = null): self
    {
        $this->t38UdptlNat = $t38UdptlNat;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getT38UdptlNat(): ?string
    {
        return $this->t38UdptlNat;
    }

    /**
     * @param int $id | null
     *
     * @return static
     */
    public function setId(?int $id = null): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param TerminalDto | null
     *
     * @return static
     */
    public function setTerminal(?TerminalDto $terminal = null): self
    {
        $this->terminal = $terminal;

        return $this;
    }

    /**
     * @return TerminalDto | null
     */
    public function getTerminal(): ?TerminalDto
    {
        return $this->terminal;
    }

    /**
     * @return static
     */
    public function setTerminalId($id): self
    {
        $value = !is_null($id)
            ? new TerminalDto($id)
            : null;

        return $this->setTerminal($value);
    }

    /**
     * @return mixed | null
     */
    public function getTerminalId()
    {
        if ($dto = $this->getTerminal()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param FriendDto | null
     *
     * @return static
     */
    public function setFriend(?FriendDto $friend = null): self
    {
        $this->friend = $friend;

        return $this;
    }

    /**
     * @return FriendDto | null
     */
    public function getFriend(): ?FriendDto
    {
        return $this->friend;
    }

    /**
     * @return static
     */
    public function setFriendId($id): self
    {
        $value = !is_null($id)
            ? new FriendDto($id)
            : null;

        return $this->setFriend($value);
    }

    /**
     * @return mixed | null
     */
    public function getFriendId()
    {
        if ($dto = $this->getFriend()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param ResidentialDeviceDto | null
     *
     * @return static
     */
    public function setResidentialDevice(?ResidentialDeviceDto $residentialDevice = null): self
    {
        $this->residentialDevice = $residentialDevice;

        return $this;
    }

    /**
     * @return ResidentialDeviceDto | null
     */
    public function getResidentialDevice(): ?ResidentialDeviceDto
    {
        return $this->residentialDevice;
    }

    /**
     * @return static
     */
    public function setResidentialDeviceId($id): self
    {
        $value = !is_null($id)
            ? new ResidentialDeviceDto($id)
            : null;

        return $this->setResidentialDevice($value);
    }

    /**
     * @return mixed | null
     */
    public function getResidentialDeviceId()
    {
        if ($dto = $this->getResidentialDevice()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param RetailAccountDto | null
     *
     * @return static
     */
    public function setRetailAccount(?RetailAccountDto $retailAccount = null): self
    {
        $this->retailAccount = $retailAccount;

        return $this;
    }

    /**
     * @return RetailAccountDto | null
     */
    public function getRetailAccount(): ?RetailAccountDto
    {
        return $this->retailAccount;
    }

    /**
     * @return static
     */
    public function setRetailAccountId($id): self
    {
        $value = !is_null($id)
            ? new RetailAccountDto($id)
            : null;

        return $this->setRetailAccount($value);
    }

    /**
     * @return mixed | null
     */
    public function getRetailAccountId()
    {
        if ($dto = $this->getRetailAccount()) {
            return $dto->getId();
        }

        return null;
    }

}
