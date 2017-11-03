<?php

namespace Ivoz\Ast\Domain\Model\PsEndpoint;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;

/**
 * @codeCoverageIgnore
 */
class PsEndpointDTO implements DataTransferObjectInterface
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
     * @var mixed
     */
    private $terminalId;

    /**
     * @var mixed
     */
    private $friendId;

    /**
     * @var mixed
     */
    private $retailAccountId;

    /**
     * @var mixed
     */
    private $terminal;

    /**
     * @var mixed
     */
    private $friend;

    /**
     * @var mixed
     */
    private $retailAccount;

    /**
     * @return array
     */
    public function __toArray()
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
            'terminalId' => $this->getTerminalId(),
            'friendId' => $this->getFriendId(),
            'retailAccountId' => $this->getRetailAccountId()
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function transformForeignKeys(ForeignKeyTransformerInterface $transformer)
    {
        $this->terminal = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Terminal\\Terminal', $this->getTerminalId());
        $this->friend = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Friend\\Friend', $this->getFriendId());
        $this->retailAccount = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\RetailAccount\\RetailAccount', $this->getRetailAccountId());
    }

    /**
     * {@inheritDoc}
     */
    public function transformCollections(CollectionTransformerInterface $transformer)
    {

    }

    /**
     * @param string $sorceryId
     *
     * @return PsEndpointDTO
     */
    public function setSorceryId($sorceryId)
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
     * @return PsEndpointDTO
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
     * @return PsEndpointDTO
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
     * @return PsEndpointDTO
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
     * @return PsEndpointDTO
     */
    public function setContext($context)
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
     * @return PsEndpointDTO
     */
    public function setDisallow($disallow)
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
     * @return PsEndpointDTO
     */
    public function setAllow($allow)
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
     * @return PsEndpointDTO
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
     * @return PsEndpointDTO
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
     * @return PsEndpointDTO
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
     * @return PsEndpointDTO
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
     * @return PsEndpointDTO
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
     * @return PsEndpointDTO
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
     * @return PsEndpointDTO
     */
    public function setOneHundredRel($oneHundredRel)
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
     * @return PsEndpointDTO
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
     * @return PsEndpointDTO
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
     * @return PsEndpointDTO
     */
    public function setId($id)
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
     * @param integer $terminalId
     *
     * @return PsEndpointDTO
     */
    public function setTerminalId($terminalId)
    {
        $this->terminalId = $terminalId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getTerminalId()
    {
        return $this->terminalId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Terminal\Terminal
     */
    public function getTerminal()
    {
        return $this->terminal;
    }

    /**
     * @param integer $friendId
     *
     * @return PsEndpointDTO
     */
    public function setFriendId($friendId)
    {
        $this->friendId = $friendId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getFriendId()
    {
        return $this->friendId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Friend\Friend
     */
    public function getFriend()
    {
        return $this->friend;
    }

    /**
     * @param integer $retailAccountId
     *
     * @return PsEndpointDTO
     */
    public function setRetailAccountId($retailAccountId)
    {
        $this->retailAccountId = $retailAccountId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getRetailAccountId()
    {
        return $this->retailAccountId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\RetailAccount\RetailAccount
     */
    public function getRetailAccount()
    {
        return $this->retailAccount;
    }
}


