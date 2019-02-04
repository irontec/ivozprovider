<?php

namespace Ivoz\Ast\Domain\Model\PsEndpoint;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class PsEndpointDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $sorceryId;

    /**
     * @var string
     */
    private $fromDomain;

    /**
     * @var string
     */
    private $aors;

    /**
     * @var string
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
     * @var string
     */
    private $directMedia = 'yes';

    /**
     * @var string
     */
    private $directMediaMethod = 'update';

    /**
     * @var string
     */
    private $mailboxes;

    /**
     * @var string
     */
    private $namedPickupGroup;

    /**
     * @var string
     */
    private $sendDiversion = 'yes';

    /**
     * @var string
     */
    private $sendPai = 'yes';

    /**
     * @var string
     */
    private $oneHundredRel = 'no';

    /**
     * @var string
     */
    private $outboundProxy;

    /**
     * @var string
     */
    private $trustIdInbound;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Ivoz\Provider\Domain\Model\Terminal\TerminalDto | null
     */
    private $terminal;

    /**
     * @var \Ivoz\Provider\Domain\Model\Friend\FriendDto | null
     */
    private $friend;

    /**
     * @var \Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceDto | null
     */
    private $residentialDevice;

    /**
     * @var \Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountDto | null
     */
    private $retailAccount;


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
        return [
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
            'id' => $this->getId(),
            'terminal' => $this->getTerminal(),
            'friend' => $this->getFriend(),
            'residentialDevice' => $this->getResidentialDevice(),
            'retailAccount' => $this->getRetailAccount()
        ];
    }

    /**
     * @param string $sorceryId
     *
     * @return static
     */
    public function setSorceryId($sorceryId = null)
    {
        $this->sorceryId = $sorceryId;

        return $this;
    }

    /**
     * @return string
     */
    public function getSorceryId()
    {
        return $this->sorceryId;
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
     * @param string $aors
     *
     * @return static
     */
    public function setAors($aors = null)
    {
        $this->aors = $aors;

        return $this;
    }

    /**
     * @return string
     */
    public function getAors()
    {
        return $this->aors;
    }

    /**
     * @param string $callerid
     *
     * @return static
     */
    public function setCallerid($callerid = null)
    {
        $this->callerid = $callerid;

        return $this;
    }

    /**
     * @return string
     */
    public function getCallerid()
    {
        return $this->callerid;
    }

    /**
     * @param string $context
     *
     * @return static
     */
    public function setContext($context = null)
    {
        $this->context = $context;

        return $this;
    }

    /**
     * @return string
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * @param string $disallow
     *
     * @return static
     */
    public function setDisallow($disallow = null)
    {
        $this->disallow = $disallow;

        return $this;
    }

    /**
     * @return string
     */
    public function getDisallow()
    {
        return $this->disallow;
    }

    /**
     * @param string $allow
     *
     * @return static
     */
    public function setAllow($allow = null)
    {
        $this->allow = $allow;

        return $this;
    }

    /**
     * @return string
     */
    public function getAllow()
    {
        return $this->allow;
    }

    /**
     * @param string $directMedia
     *
     * @return static
     */
    public function setDirectMedia($directMedia = null)
    {
        $this->directMedia = $directMedia;

        return $this;
    }

    /**
     * @return string
     */
    public function getDirectMedia()
    {
        return $this->directMedia;
    }

    /**
     * @param string $directMediaMethod
     *
     * @return static
     */
    public function setDirectMediaMethod($directMediaMethod = null)
    {
        $this->directMediaMethod = $directMediaMethod;

        return $this;
    }

    /**
     * @return string
     */
    public function getDirectMediaMethod()
    {
        return $this->directMediaMethod;
    }

    /**
     * @param string $mailboxes
     *
     * @return static
     */
    public function setMailboxes($mailboxes = null)
    {
        $this->mailboxes = $mailboxes;

        return $this;
    }

    /**
     * @return string
     */
    public function getMailboxes()
    {
        return $this->mailboxes;
    }

    /**
     * @param string $namedPickupGroup
     *
     * @return static
     */
    public function setNamedPickupGroup($namedPickupGroup = null)
    {
        $this->namedPickupGroup = $namedPickupGroup;

        return $this;
    }

    /**
     * @return string
     */
    public function getNamedPickupGroup()
    {
        return $this->namedPickupGroup;
    }

    /**
     * @param string $sendDiversion
     *
     * @return static
     */
    public function setSendDiversion($sendDiversion = null)
    {
        $this->sendDiversion = $sendDiversion;

        return $this;
    }

    /**
     * @return string
     */
    public function getSendDiversion()
    {
        return $this->sendDiversion;
    }

    /**
     * @param string $sendPai
     *
     * @return static
     */
    public function setSendPai($sendPai = null)
    {
        $this->sendPai = $sendPai;

        return $this;
    }

    /**
     * @return string
     */
    public function getSendPai()
    {
        return $this->sendPai;
    }

    /**
     * @param string $oneHundredRel
     *
     * @return static
     */
    public function setOneHundredRel($oneHundredRel = null)
    {
        $this->oneHundredRel = $oneHundredRel;

        return $this;
    }

    /**
     * @return string
     */
    public function getOneHundredRel()
    {
        return $this->oneHundredRel;
    }

    /**
     * @param string $outboundProxy
     *
     * @return static
     */
    public function setOutboundProxy($outboundProxy = null)
    {
        $this->outboundProxy = $outboundProxy;

        return $this;
    }

    /**
     * @return string
     */
    public function getOutboundProxy()
    {
        return $this->outboundProxy;
    }

    /**
     * @param string $trustIdInbound
     *
     * @return static
     */
    public function setTrustIdInbound($trustIdInbound = null)
    {
        $this->trustIdInbound = $trustIdInbound;

        return $this;
    }

    /**
     * @return string
     */
    public function getTrustIdInbound()
    {
        return $this->trustIdInbound;
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

    /**
     * @param \Ivoz\Provider\Domain\Model\Terminal\TerminalDto $terminal
     *
     * @return static
     */
    public function setTerminal(\Ivoz\Provider\Domain\Model\Terminal\TerminalDto $terminal = null)
    {
        $this->terminal = $terminal;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Terminal\TerminalDto
     */
    public function getTerminal()
    {
        return $this->terminal;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setTerminalId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Terminal\TerminalDto($id)
            : null;

        return $this->setTerminal($value);
    }

    /**
     * @return integer | null
     */
    public function getTerminalId()
    {
        if ($dto = $this->getTerminal()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Friend\FriendDto $friend
     *
     * @return static
     */
    public function setFriend(\Ivoz\Provider\Domain\Model\Friend\FriendDto $friend = null)
    {
        $this->friend = $friend;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Friend\FriendDto
     */
    public function getFriend()
    {
        return $this->friend;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setFriendId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Friend\FriendDto($id)
            : null;

        return $this->setFriend($value);
    }

    /**
     * @return integer | null
     */
    public function getFriendId()
    {
        if ($dto = $this->getFriend()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceDto $residentialDevice
     *
     * @return static
     */
    public function setResidentialDevice(\Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceDto $residentialDevice = null)
    {
        $this->residentialDevice = $residentialDevice;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceDto
     */
    public function getResidentialDevice()
    {
        return $this->residentialDevice;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setResidentialDeviceId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceDto($id)
            : null;

        return $this->setResidentialDevice($value);
    }

    /**
     * @return integer | null
     */
    public function getResidentialDeviceId()
    {
        if ($dto = $this->getResidentialDevice()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountDto $retailAccount
     *
     * @return static
     */
    public function setRetailAccount(\Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountDto $retailAccount = null)
    {
        $this->retailAccount = $retailAccount;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountDto
     */
    public function getRetailAccount()
    {
        return $this->retailAccount;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setRetailAccountId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountDto($id)
            : null;

        return $this->setRetailAccount($value);
    }

    /**
     * @return integer | null
     */
    public function getRetailAccountId()
    {
        if ($dto = $this->getRetailAccount()) {
            return $dto->getId();
        }

        return null;
    }
}
