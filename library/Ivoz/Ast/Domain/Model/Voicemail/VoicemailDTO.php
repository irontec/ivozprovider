<?php

namespace Ivoz\Ast\Domain\Model\Voicemail;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;

/**
 * @codeCoverageIgnore
 */
class VoicemailDTO implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $context;

    /**
     * @var string
     */
    private $mailbox;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $fullname;

    /**
     * @var string
     */
    private $alias;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $pager;

    /**
     * @var string
     */
    private $attach;

    /**
     * @var string
     */
    private $attachfmt;

    /**
     * @var string
     */
    private $serveremail;

    /**
     * @var string
     */
    private $language;

    /**
     * @var string
     */
    private $tz;

    /**
     * @var string
     */
    private $deleteVoicemail;

    /**
     * @var string
     */
    private $saycid;

    /**
     * @var string
     */
    private $sendVoicemail;

    /**
     * @var string
     */
    private $review;

    /**
     * @var string
     */
    private $tempgreetwarn;

    /**
     * @var string
     */
    private $operator;

    /**
     * @var string
     */
    private $envelope;

    /**
     * @var integer
     */
    private $sayduration;

    /**
     * @var string
     */
    private $forcename;

    /**
     * @var string
     */
    private $forcegreetings;

    /**
     * @var string
     */
    private $callback;

    /**
     * @var string
     */
    private $dialout;

    /**
     * @var string
     */
    private $exitcontext;

    /**
     * @var integer
     */
    private $maxmsg;

    /**
     * @var string
     */
    private $volgain;

    /**
     * @var string
     */
    private $imapuser;

    /**
     * @var string
     */
    private $imappassword;

    /**
     * @var string
     */
    private $imapserver;

    /**
     * @var string
     */
    private $imapport;

    /**
     * @var string
     */
    private $imapflags;

    /**
     * @var \DateTime
     */
    private $stamp;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var mixed
     */
    private $userId;

    /**
     * @var mixed
     */
    private $user;

    /**
     * {@inheritDoc}
     */
    public function transformForeignKeys(ForeignKeyTransformerInterface $transformer)
    {
        $this->user = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\User\\User', $this->getUserId());
    }

    /**
     * {@inheritDoc}
     */
    public function transformCollections(CollectionTransformerInterface $transformer)
    {

    }

    /**
     * @param string $context
     *
     * @return VoicemailDTO
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
     * @param string $mailbox
     *
     * @return VoicemailDTO
     */
    public function setMailbox($mailbox)
    {
        $this->mailbox = $mailbox;

        return $this;
    }

    /**
     * @return string
     */
    public function getMailbox()
    {
        return $this->mailbox;
    }

    /**
     * @param string $password
     *
     * @return VoicemailDTO
     */
    public function setPassword($password = null)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $fullname
     *
     * @return VoicemailDTO
     */
    public function setFullname($fullname = null)
    {
        $this->fullname = $fullname;

        return $this;
    }

    /**
     * @return string
     */
    public function getFullname()
    {
        return $this->fullname;
    }

    /**
     * @param string $alias
     *
     * @return VoicemailDTO
     */
    public function setAlias($alias = null)
    {
        $this->alias = $alias;

        return $this;
    }

    /**
     * @return string
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * @param string $email
     *
     * @return VoicemailDTO
     */
    public function setEmail($email = null)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $pager
     *
     * @return VoicemailDTO
     */
    public function setPager($pager = null)
    {
        $this->pager = $pager;

        return $this;
    }

    /**
     * @return string
     */
    public function getPager()
    {
        return $this->pager;
    }

    /**
     * @param string $attach
     *
     * @return VoicemailDTO
     */
    public function setAttach($attach = null)
    {
        $this->attach = $attach;

        return $this;
    }

    /**
     * @return string
     */
    public function getAttach()
    {
        return $this->attach;
    }

    /**
     * @param string $attachfmt
     *
     * @return VoicemailDTO
     */
    public function setAttachfmt($attachfmt = null)
    {
        $this->attachfmt = $attachfmt;

        return $this;
    }

    /**
     * @return string
     */
    public function getAttachfmt()
    {
        return $this->attachfmt;
    }

    /**
     * @param string $serveremail
     *
     * @return VoicemailDTO
     */
    public function setServeremail($serveremail = null)
    {
        $this->serveremail = $serveremail;

        return $this;
    }

    /**
     * @return string
     */
    public function getServeremail()
    {
        return $this->serveremail;
    }

    /**
     * @param string $language
     *
     * @return VoicemailDTO
     */
    public function setLanguage($language = null)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param string $tz
     *
     * @return VoicemailDTO
     */
    public function setTz($tz = null)
    {
        $this->tz = $tz;

        return $this;
    }

    /**
     * @return string
     */
    public function getTz()
    {
        return $this->tz;
    }

    /**
     * @param string $deleteVoicemail
     *
     * @return VoicemailDTO
     */
    public function setDeleteVoicemail($deleteVoicemail = null)
    {
        $this->deleteVoicemail = $deleteVoicemail;

        return $this;
    }

    /**
     * @return string
     */
    public function getDeleteVoicemail()
    {
        return $this->deleteVoicemail;
    }

    /**
     * @param string $saycid
     *
     * @return VoicemailDTO
     */
    public function setSaycid($saycid = null)
    {
        $this->saycid = $saycid;

        return $this;
    }

    /**
     * @return string
     */
    public function getSaycid()
    {
        return $this->saycid;
    }

    /**
     * @param string $sendVoicemail
     *
     * @return VoicemailDTO
     */
    public function setSendVoicemail($sendVoicemail = null)
    {
        $this->sendVoicemail = $sendVoicemail;

        return $this;
    }

    /**
     * @return string
     */
    public function getSendVoicemail()
    {
        return $this->sendVoicemail;
    }

    /**
     * @param string $review
     *
     * @return VoicemailDTO
     */
    public function setReview($review = null)
    {
        $this->review = $review;

        return $this;
    }

    /**
     * @return string
     */
    public function getReview()
    {
        return $this->review;
    }

    /**
     * @param string $tempgreetwarn
     *
     * @return VoicemailDTO
     */
    public function setTempgreetwarn($tempgreetwarn = null)
    {
        $this->tempgreetwarn = $tempgreetwarn;

        return $this;
    }

    /**
     * @return string
     */
    public function getTempgreetwarn()
    {
        return $this->tempgreetwarn;
    }

    /**
     * @param string $operator
     *
     * @return VoicemailDTO
     */
    public function setOperator($operator = null)
    {
        $this->operator = $operator;

        return $this;
    }

    /**
     * @return string
     */
    public function getOperator()
    {
        return $this->operator;
    }

    /**
     * @param string $envelope
     *
     * @return VoicemailDTO
     */
    public function setEnvelope($envelope = null)
    {
        $this->envelope = $envelope;

        return $this;
    }

    /**
     * @return string
     */
    public function getEnvelope()
    {
        return $this->envelope;
    }

    /**
     * @param integer $sayduration
     *
     * @return VoicemailDTO
     */
    public function setSayduration($sayduration = null)
    {
        $this->sayduration = $sayduration;

        return $this;
    }

    /**
     * @return integer
     */
    public function getSayduration()
    {
        return $this->sayduration;
    }

    /**
     * @param string $forcename
     *
     * @return VoicemailDTO
     */
    public function setForcename($forcename = null)
    {
        $this->forcename = $forcename;

        return $this;
    }

    /**
     * @return string
     */
    public function getForcename()
    {
        return $this->forcename;
    }

    /**
     * @param string $forcegreetings
     *
     * @return VoicemailDTO
     */
    public function setForcegreetings($forcegreetings = null)
    {
        $this->forcegreetings = $forcegreetings;

        return $this;
    }

    /**
     * @return string
     */
    public function getForcegreetings()
    {
        return $this->forcegreetings;
    }

    /**
     * @param string $callback
     *
     * @return VoicemailDTO
     */
    public function setCallback($callback = null)
    {
        $this->callback = $callback;

        return $this;
    }

    /**
     * @return string
     */
    public function getCallback()
    {
        return $this->callback;
    }

    /**
     * @param string $dialout
     *
     * @return VoicemailDTO
     */
    public function setDialout($dialout = null)
    {
        $this->dialout = $dialout;

        return $this;
    }

    /**
     * @return string
     */
    public function getDialout()
    {
        return $this->dialout;
    }

    /**
     * @param string $exitcontext
     *
     * @return VoicemailDTO
     */
    public function setExitcontext($exitcontext = null)
    {
        $this->exitcontext = $exitcontext;

        return $this;
    }

    /**
     * @return string
     */
    public function getExitcontext()
    {
        return $this->exitcontext;
    }

    /**
     * @param integer $maxmsg
     *
     * @return VoicemailDTO
     */
    public function setMaxmsg($maxmsg = null)
    {
        $this->maxmsg = $maxmsg;

        return $this;
    }

    /**
     * @return integer
     */
    public function getMaxmsg()
    {
        return $this->maxmsg;
    }

    /**
     * @param string $volgain
     *
     * @return VoicemailDTO
     */
    public function setVolgain($volgain = null)
    {
        $this->volgain = $volgain;

        return $this;
    }

    /**
     * @return string
     */
    public function getVolgain()
    {
        return $this->volgain;
    }

    /**
     * @param string $imapuser
     *
     * @return VoicemailDTO
     */
    public function setImapuser($imapuser = null)
    {
        $this->imapuser = $imapuser;

        return $this;
    }

    /**
     * @return string
     */
    public function getImapuser()
    {
        return $this->imapuser;
    }

    /**
     * @param string $imappassword
     *
     * @return VoicemailDTO
     */
    public function setImappassword($imappassword = null)
    {
        $this->imappassword = $imappassword;

        return $this;
    }

    /**
     * @return string
     */
    public function getImappassword()
    {
        return $this->imappassword;
    }

    /**
     * @param string $imapserver
     *
     * @return VoicemailDTO
     */
    public function setImapserver($imapserver = null)
    {
        $this->imapserver = $imapserver;

        return $this;
    }

    /**
     * @return string
     */
    public function getImapserver()
    {
        return $this->imapserver;
    }

    /**
     * @param string $imapport
     *
     * @return VoicemailDTO
     */
    public function setImapport($imapport = null)
    {
        $this->imapport = $imapport;

        return $this;
    }

    /**
     * @return string
     */
    public function getImapport()
    {
        return $this->imapport;
    }

    /**
     * @param string $imapflags
     *
     * @return VoicemailDTO
     */
    public function setImapflags($imapflags = null)
    {
        $this->imapflags = $imapflags;

        return $this;
    }

    /**
     * @return string
     */
    public function getImapflags()
    {
        return $this->imapflags;
    }

    /**
     * @param \DateTime $stamp
     *
     * @return VoicemailDTO
     */
    public function setStamp($stamp = null)
    {
        $this->stamp = $stamp;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getStamp()
    {
        return $this->stamp;
    }

    /**
     * @param integer $id
     *
     * @return VoicemailDTO
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
     * @param integer $userId
     *
     * @return VoicemailDTO
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\User\User
     */
    public function getUser()
    {
        return $this->user;
    }
}


