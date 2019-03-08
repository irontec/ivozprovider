<?php

namespace Ivoz\Ast\Domain\Model\Voicemail;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class VoicemailDtoAbstract implements DataTransferObjectInterface
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
    private $saycid = 'yes';

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
     * @var float
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
     * @var \Ivoz\Provider\Domain\Model\User\UserDto | null
     */
    private $user;

    /**
     * @var \Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceDto | null
     */
    private $residentialDevice;


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
            'context' => 'context',
            'mailbox' => 'mailbox',
            'password' => 'password',
            'fullname' => 'fullname',
            'alias' => 'alias',
            'email' => 'email',
            'pager' => 'pager',
            'attach' => 'attach',
            'attachfmt' => 'attachfmt',
            'serveremail' => 'serveremail',
            'language' => 'language',
            'tz' => 'tz',
            'deleteVoicemail' => 'deleteVoicemail',
            'saycid' => 'saycid',
            'sendVoicemail' => 'sendVoicemail',
            'review' => 'review',
            'tempgreetwarn' => 'tempgreetwarn',
            'operator' => 'operator',
            'envelope' => 'envelope',
            'sayduration' => 'sayduration',
            'forcename' => 'forcename',
            'forcegreetings' => 'forcegreetings',
            'callback' => 'callback',
            'dialout' => 'dialout',
            'exitcontext' => 'exitcontext',
            'maxmsg' => 'maxmsg',
            'volgain' => 'volgain',
            'imapuser' => 'imapuser',
            'imappassword' => 'imappassword',
            'imapserver' => 'imapserver',
            'imapport' => 'imapport',
            'imapflags' => 'imapflags',
            'stamp' => 'stamp',
            'id' => 'id',
            'userId' => 'user',
            'residentialDeviceId' => 'residentialDevice'
        ];
    }

    /**
     * @return array
     */
    public function toArray($hideSensitiveData = false)
    {
        return [
            'context' => $this->getContext(),
            'mailbox' => $this->getMailbox(),
            'password' => $this->getPassword(),
            'fullname' => $this->getFullname(),
            'alias' => $this->getAlias(),
            'email' => $this->getEmail(),
            'pager' => $this->getPager(),
            'attach' => $this->getAttach(),
            'attachfmt' => $this->getAttachfmt(),
            'serveremail' => $this->getServeremail(),
            'language' => $this->getLanguage(),
            'tz' => $this->getTz(),
            'deleteVoicemail' => $this->getDeleteVoicemail(),
            'saycid' => $this->getSaycid(),
            'sendVoicemail' => $this->getSendVoicemail(),
            'review' => $this->getReview(),
            'tempgreetwarn' => $this->getTempgreetwarn(),
            'operator' => $this->getOperator(),
            'envelope' => $this->getEnvelope(),
            'sayduration' => $this->getSayduration(),
            'forcename' => $this->getForcename(),
            'forcegreetings' => $this->getForcegreetings(),
            'callback' => $this->getCallback(),
            'dialout' => $this->getDialout(),
            'exitcontext' => $this->getExitcontext(),
            'maxmsg' => $this->getMaxmsg(),
            'volgain' => $this->getVolgain(),
            'imapuser' => $this->getImapuser(),
            'imappassword' => $this->getImappassword(),
            'imapserver' => $this->getImapserver(),
            'imapport' => $this->getImapport(),
            'imapflags' => $this->getImapflags(),
            'stamp' => $this->getStamp(),
            'id' => $this->getId(),
            'user' => $this->getUser(),
            'residentialDevice' => $this->getResidentialDevice()
        ];
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
     * @param string $mailbox
     *
     * @return static
     */
    public function setMailbox($mailbox = null)
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
     * @return static
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
     * @return static
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
     * @return static
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
     * @return static
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
     * @return static
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
     * @return static
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
     * @return static
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
     * @return static
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
     * @return static
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
     * @return static
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
     * @return static
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
     * @return static
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
     * @return static
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
     * @return static
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
     * @return static
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
     * @return static
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
     * @return static
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
     * @return static
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
     * @return static
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
     * @return static
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
     * @return static
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
     * @return static
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
     * @return static
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
     * @return static
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
     * @param float $volgain
     *
     * @return static
     */
    public function setVolgain($volgain = null)
    {
        $this->volgain = $volgain;

        return $this;
    }

    /**
     * @return float
     */
    public function getVolgain()
    {
        return $this->volgain;
    }

    /**
     * @param string $imapuser
     *
     * @return static
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
     * @return static
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
     * @return static
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
     * @return static
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
     * @return static
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
     * @return static
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
     * @param \Ivoz\Provider\Domain\Model\User\UserDto $user
     *
     * @return static
     */
    public function setUser(\Ivoz\Provider\Domain\Model\User\UserDto $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\User\UserDto
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setUserId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\User\UserDto($id)
            : null;

        return $this->setUser($value);
    }

    /**
     * @return integer | null
     */
    public function getUserId()
    {
        if ($dto = $this->getUser()) {
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
}
