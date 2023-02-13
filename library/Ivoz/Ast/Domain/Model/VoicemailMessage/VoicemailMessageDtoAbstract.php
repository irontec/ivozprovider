<?php

namespace Ivoz\Ast\Domain\Model\VoicemailMessage;

use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\DtoNormalizer;

/**
* VoicemailMessageDtoAbstract
* @codeCoverageIgnore
*/
abstract class VoicemailMessageDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string|null
     */
    private $dir = null;

    /**
     * @var int|null
     */
    private $msgnum = 0;

    /**
     * @var string|null
     */
    private $context = null;

    /**
     * @var string|null
     */
    private $macrocontext = null;

    /**
     * @var string|null
     */
    private $callerid = null;

    /**
     * @var int|null
     */
    private $origtime = 0;

    /**
     * @var int|null
     */
    private $duration = 0;

    /**
     * @var string|null
     */
    private $recording = null;

    /**
     * @var string|null
     */
    private $flag = null;

    /**
     * @var string|null
     */
    private $category = null;

    /**
     * @var string|null
     */
    private $mailboxuser = null;

    /**
     * @var string|null
     */
    private $mailboxcontext = null;

    /**
     * @var string|null
     */
    private $msgId = null;

    /**
     * @var bool|null
     */
    private $parsed = false;

    /**
     * @var int|null
     */
    private $id = null;

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
            'dir' => 'dir',
            'msgnum' => 'msgnum',
            'context' => 'context',
            'macrocontext' => 'macrocontext',
            'callerid' => 'callerid',
            'origtime' => 'origtime',
            'duration' => 'duration',
            'recording' => 'recording',
            'flag' => 'flag',
            'category' => 'category',
            'mailboxuser' => 'mailboxuser',
            'mailboxcontext' => 'mailboxcontext',
            'msgId' => 'msgId',
            'parsed' => 'parsed',
            'id' => 'id'
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(bool $hideSensitiveData = false): array
    {
        $response = [
            'dir' => $this->getDir(),
            'msgnum' => $this->getMsgnum(),
            'context' => $this->getContext(),
            'macrocontext' => $this->getMacrocontext(),
            'callerid' => $this->getCallerid(),
            'origtime' => $this->getOrigtime(),
            'duration' => $this->getDuration(),
            'recording' => $this->getRecording(),
            'flag' => $this->getFlag(),
            'category' => $this->getCategory(),
            'mailboxuser' => $this->getMailboxuser(),
            'mailboxcontext' => $this->getMailboxcontext(),
            'msgId' => $this->getMsgId(),
            'parsed' => $this->getParsed(),
            'id' => $this->getId()
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

    public function setDir(string $dir): static
    {
        $this->dir = $dir;

        return $this;
    }

    public function getDir(): ?string
    {
        return $this->dir;
    }

    public function setMsgnum(int $msgnum): static
    {
        $this->msgnum = $msgnum;

        return $this;
    }

    public function getMsgnum(): ?int
    {
        return $this->msgnum;
    }

    public function setContext(?string $context): static
    {
        $this->context = $context;

        return $this;
    }

    public function getContext(): ?string
    {
        return $this->context;
    }

    public function setMacrocontext(?string $macrocontext): static
    {
        $this->macrocontext = $macrocontext;

        return $this;
    }

    public function getMacrocontext(): ?string
    {
        return $this->macrocontext;
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

    public function setOrigtime(int $origtime): static
    {
        $this->origtime = $origtime;

        return $this;
    }

    public function getOrigtime(): ?int
    {
        return $this->origtime;
    }

    public function setDuration(int $duration): static
    {
        $this->duration = $duration;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setRecording(?string $recording): static
    {
        $this->recording = $recording;

        return $this;
    }

    public function getRecording(): ?string
    {
        return $this->recording;
    }

    public function setFlag(?string $flag): static
    {
        $this->flag = $flag;

        return $this;
    }

    public function getFlag(): ?string
    {
        return $this->flag;
    }

    public function setCategory(?string $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setMailboxuser(string $mailboxuser): static
    {
        $this->mailboxuser = $mailboxuser;

        return $this;
    }

    public function getMailboxuser(): ?string
    {
        return $this->mailboxuser;
    }

    public function setMailboxcontext(string $mailboxcontext): static
    {
        $this->mailboxcontext = $mailboxcontext;

        return $this;
    }

    public function getMailboxcontext(): ?string
    {
        return $this->mailboxcontext;
    }

    public function setMsgId(?string $msgId): static
    {
        $this->msgId = $msgId;

        return $this;
    }

    public function getMsgId(): ?string
    {
        return $this->msgId;
    }

    public function setParsed(bool $parsed): static
    {
        $this->parsed = $parsed;

        return $this;
    }

    public function getParsed(): ?bool
    {
        return $this->parsed;
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
}
