<?php

namespace Ivoz\Ast\Domain\Model\Voicemail;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\User\UserDto;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceDto;

/**
* VoicemailDtoAbstract
* @codeCoverageIgnore
*/
abstract class VoicemailDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string
     */
    private $context;

    /**
     * @var string
     */
    private $mailbox;

    /**
     * @var string | null
     */
    private $password;

    /**
     * @var string | null
     */
    private $fullname;

    /**
     * @var string | null
     */
    private $alias;

    /**
     * @var string | null
     */
    private $email;

    /**
     * @var string | null
     */
    private $pager;

    /**
     * @var string | null
     */
    private $attach;

    /**
     * @var string | null
     */
    private $attachfmt;

    /**
     * @var string | null
     */
    private $serveremail;

    /**
     * @var string | null
     */
    private $language;

    /**
     * @var string | null
     */
    private $tz;

    /**
     * @var string | null
     */
    private $deleteVoicemail;

    /**
     * @var string | null
     */
    private $saycid = 'yes';

    /**
     * @var string | null
     */
    private $sendVoicemail;

    /**
     * @var string | null
     */
    private $review;

    /**
     * @var string | null
     */
    private $tempgreetwarn;

    /**
     * @var string | null
     */
    private $operator;

    /**
     * @var string | null
     */
    private $envelope;

    /**
     * @var int | null
     */
    private $sayduration;

    /**
     * @var string | null
     */
    private $forcename;

    /**
     * @var string | null
     */
    private $forcegreetings;

    /**
     * @var string | null
     */
    private $callback;

    /**
     * @var string | null
     */
    private $dialout;

    /**
     * @var string | null
     */
    private $exitcontext;

    /**
     * @var int | null
     */
    private $maxmsg;

    /**
     * @var float | null
     */
    private $volgain;

    /**
     * @var string | null
     */
    private $imapuser;

    /**
     * @var string | null
     */
    private $imappassword;

    /**
     * @var string | null
     */
    private $imapserver;

    /**
     * @var string | null
     */
    private $imapport;

    /**
     * @var string | null
     */
    private $imapflags;

    /**
     * @var \DateTimeInterface | null
     */
    private $stamp;

    /**
     * @var int
     */
    private $id;

    /**
     * @var UserDto | null
     */
    private $user;

    /**
     * @var ResidentialDeviceDto | null
     */
    private $residentialDevice;

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
        $response = [
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
     * @param string $mailbox | null
     *
     * @return static
     */
    public function setMailbox(?string $mailbox = null): self
    {
        $this->mailbox = $mailbox;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getMailbox(): ?string
    {
        return $this->mailbox;
    }

    /**
     * @param string $password | null
     *
     * @return static
     */
    public function setPassword(?string $password = null): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string $fullname | null
     *
     * @return static
     */
    public function setFullname(?string $fullname = null): self
    {
        $this->fullname = $fullname;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getFullname(): ?string
    {
        return $this->fullname;
    }

    /**
     * @param string $alias | null
     *
     * @return static
     */
    public function setAlias(?string $alias = null): self
    {
        $this->alias = $alias;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getAlias(): ?string
    {
        return $this->alias;
    }

    /**
     * @param string $email | null
     *
     * @return static
     */
    public function setEmail(?string $email = null): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string $pager | null
     *
     * @return static
     */
    public function setPager(?string $pager = null): self
    {
        $this->pager = $pager;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getPager(): ?string
    {
        return $this->pager;
    }

    /**
     * @param string $attach | null
     *
     * @return static
     */
    public function setAttach(?string $attach = null): self
    {
        $this->attach = $attach;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getAttach(): ?string
    {
        return $this->attach;
    }

    /**
     * @param string $attachfmt | null
     *
     * @return static
     */
    public function setAttachfmt(?string $attachfmt = null): self
    {
        $this->attachfmt = $attachfmt;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getAttachfmt(): ?string
    {
        return $this->attachfmt;
    }

    /**
     * @param string $serveremail | null
     *
     * @return static
     */
    public function setServeremail(?string $serveremail = null): self
    {
        $this->serveremail = $serveremail;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getServeremail(): ?string
    {
        return $this->serveremail;
    }

    /**
     * @param string $language | null
     *
     * @return static
     */
    public function setLanguage(?string $language = null): self
    {
        $this->language = $language;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getLanguage(): ?string
    {
        return $this->language;
    }

    /**
     * @param string $tz | null
     *
     * @return static
     */
    public function setTz(?string $tz = null): self
    {
        $this->tz = $tz;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getTz(): ?string
    {
        return $this->tz;
    }

    /**
     * @param string $deleteVoicemail | null
     *
     * @return static
     */
    public function setDeleteVoicemail(?string $deleteVoicemail = null): self
    {
        $this->deleteVoicemail = $deleteVoicemail;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDeleteVoicemail(): ?string
    {
        return $this->deleteVoicemail;
    }

    /**
     * @param string $saycid | null
     *
     * @return static
     */
    public function setSaycid(?string $saycid = null): self
    {
        $this->saycid = $saycid;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getSaycid(): ?string
    {
        return $this->saycid;
    }

    /**
     * @param string $sendVoicemail | null
     *
     * @return static
     */
    public function setSendVoicemail(?string $sendVoicemail = null): self
    {
        $this->sendVoicemail = $sendVoicemail;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getSendVoicemail(): ?string
    {
        return $this->sendVoicemail;
    }

    /**
     * @param string $review | null
     *
     * @return static
     */
    public function setReview(?string $review = null): self
    {
        $this->review = $review;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getReview(): ?string
    {
        return $this->review;
    }

    /**
     * @param string $tempgreetwarn | null
     *
     * @return static
     */
    public function setTempgreetwarn(?string $tempgreetwarn = null): self
    {
        $this->tempgreetwarn = $tempgreetwarn;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getTempgreetwarn(): ?string
    {
        return $this->tempgreetwarn;
    }

    /**
     * @param string $operator | null
     *
     * @return static
     */
    public function setOperator(?string $operator = null): self
    {
        $this->operator = $operator;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getOperator(): ?string
    {
        return $this->operator;
    }

    /**
     * @param string $envelope | null
     *
     * @return static
     */
    public function setEnvelope(?string $envelope = null): self
    {
        $this->envelope = $envelope;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getEnvelope(): ?string
    {
        return $this->envelope;
    }

    /**
     * @param int $sayduration | null
     *
     * @return static
     */
    public function setSayduration(?int $sayduration = null): self
    {
        $this->sayduration = $sayduration;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getSayduration(): ?int
    {
        return $this->sayduration;
    }

    /**
     * @param string $forcename | null
     *
     * @return static
     */
    public function setForcename(?string $forcename = null): self
    {
        $this->forcename = $forcename;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getForcename(): ?string
    {
        return $this->forcename;
    }

    /**
     * @param string $forcegreetings | null
     *
     * @return static
     */
    public function setForcegreetings(?string $forcegreetings = null): self
    {
        $this->forcegreetings = $forcegreetings;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getForcegreetings(): ?string
    {
        return $this->forcegreetings;
    }

    /**
     * @param string $callback | null
     *
     * @return static
     */
    public function setCallback(?string $callback = null): self
    {
        $this->callback = $callback;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getCallback(): ?string
    {
        return $this->callback;
    }

    /**
     * @param string $dialout | null
     *
     * @return static
     */
    public function setDialout(?string $dialout = null): self
    {
        $this->dialout = $dialout;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDialout(): ?string
    {
        return $this->dialout;
    }

    /**
     * @param string $exitcontext | null
     *
     * @return static
     */
    public function setExitcontext(?string $exitcontext = null): self
    {
        $this->exitcontext = $exitcontext;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getExitcontext(): ?string
    {
        return $this->exitcontext;
    }

    /**
     * @param int $maxmsg | null
     *
     * @return static
     */
    public function setMaxmsg(?int $maxmsg = null): self
    {
        $this->maxmsg = $maxmsg;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getMaxmsg(): ?int
    {
        return $this->maxmsg;
    }

    /**
     * @param float $volgain | null
     *
     * @return static
     */
    public function setVolgain(?float $volgain = null): self
    {
        $this->volgain = $volgain;

        return $this;
    }

    /**
     * @return float | null
     */
    public function getVolgain(): ?float
    {
        return $this->volgain;
    }

    /**
     * @param string $imapuser | null
     *
     * @return static
     */
    public function setImapuser(?string $imapuser = null): self
    {
        $this->imapuser = $imapuser;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getImapuser(): ?string
    {
        return $this->imapuser;
    }

    /**
     * @param string $imappassword | null
     *
     * @return static
     */
    public function setImappassword(?string $imappassword = null): self
    {
        $this->imappassword = $imappassword;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getImappassword(): ?string
    {
        return $this->imappassword;
    }

    /**
     * @param string $imapserver | null
     *
     * @return static
     */
    public function setImapserver(?string $imapserver = null): self
    {
        $this->imapserver = $imapserver;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getImapserver(): ?string
    {
        return $this->imapserver;
    }

    /**
     * @param string $imapport | null
     *
     * @return static
     */
    public function setImapport(?string $imapport = null): self
    {
        $this->imapport = $imapport;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getImapport(): ?string
    {
        return $this->imapport;
    }

    /**
     * @param string $imapflags | null
     *
     * @return static
     */
    public function setImapflags(?string $imapflags = null): self
    {
        $this->imapflags = $imapflags;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getImapflags(): ?string
    {
        return $this->imapflags;
    }

    /**
     * @param \DateTimeInterface $stamp | null
     *
     * @return static
     */
    public function setStamp($stamp = null): self
    {
        $this->stamp = $stamp;

        return $this;
    }

    /**
     * @return \DateTimeInterface | null
     */
    public function getStamp()
    {
        return $this->stamp;
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
     * @param UserDto | null
     *
     * @return static
     */
    public function setUser(?UserDto $user = null): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return UserDto | null
     */
    public function getUser(): ?UserDto
    {
        return $this->user;
    }

    /**
     * @return static
     */
    public function setUserId($id): self
    {
        $value = !is_null($id)
            ? new UserDto($id)
            : null;

        return $this->setUser($value);
    }

    /**
     * @return mixed | null
     */
    public function getUserId()
    {
        if ($dto = $this->getUser()) {
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

}
