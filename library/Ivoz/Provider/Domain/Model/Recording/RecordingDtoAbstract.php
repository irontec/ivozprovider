<?php

namespace Ivoz\Provider\Domain\Model\Recording;

use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\UsersCdr\UsersCdrDto;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use Ivoz\Provider\Domain\Model\Ddi\DdiDto;
use Ivoz\Provider\Domain\Model\User\UserDto;

/**
* RecordingDtoAbstract
* @codeCoverageIgnore
*/
abstract class RecordingDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string|null
     */
    private $callid = null;

    /**
     * @var \DateTimeInterface|string|null
     */
    private $calldate = 'CURRENT_TIMESTAMP';

    /**
     * @var string|null
     */
    private $type = 'ddi';

    /**
     * @var float|null
     */
    private $duration = 0;

    /**
     * @var string|null
     */
    private $caller = null;

    /**
     * @var string|null
     */
    private $callee = null;

    /**
     * @var string|null
     */
    private $recorder = null;

    /**
     * @var int|null
     */
    private $id = null;

    /**
     * @var int|null
     */
    private $recordedFileFileSize = null;

    /**
     * @var string|null
     */
    private $recordedFileMimeType = null;

    /**
     * @var string|null
     */
    private $recordedFileBaseName = null;

    /**
     * @var UsersCdrDto | null
     */
    private $usersCdr = null;

    /**
     * @var CompanyDto | null
     */
    private $company = null;

    /**
     * @var DdiDto | null
     */
    private $ddi = null;

    /**
     * @var UserDto | null
     */
    private $user = null;

    public function __construct(?int $id = null)
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
            'callid' => 'callid',
            'calldate' => 'calldate',
            'type' => 'type',
            'duration' => 'duration',
            'caller' => 'caller',
            'callee' => 'callee',
            'recorder' => 'recorder',
            'id' => 'id',
            'recordedFile' => [
                'fileSize',
                'mimeType',
                'baseName',
            ],
            'usersCdrId' => 'usersCdr',
            'companyId' => 'company',
            'ddiId' => 'ddi',
            'userId' => 'user'
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(bool $hideSensitiveData = false): array
    {
        $response = [
            'callid' => $this->getCallid(),
            'calldate' => $this->getCalldate(),
            'type' => $this->getType(),
            'duration' => $this->getDuration(),
            'caller' => $this->getCaller(),
            'callee' => $this->getCallee(),
            'recorder' => $this->getRecorder(),
            'id' => $this->getId(),
            'recordedFile' => [
                'fileSize' => $this->getRecordedFileFileSize(),
                'mimeType' => $this->getRecordedFileMimeType(),
                'baseName' => $this->getRecordedFileBaseName(),
            ],
            'usersCdr' => $this->getUsersCdr(),
            'company' => $this->getCompany(),
            'ddi' => $this->getDdi(),
            'user' => $this->getUser()
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

    public function setCallid(?string $callid): static
    {
        $this->callid = $callid;

        return $this;
    }

    public function getCallid(): ?string
    {
        return $this->callid;
    }

    public function setCalldate(\DateTimeInterface|string $calldate): static
    {
        $this->calldate = $calldate;

        return $this;
    }

    public function getCalldate(): \DateTimeInterface|string|null
    {
        return $this->calldate;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setDuration(float $duration): static
    {
        $this->duration = $duration;

        return $this;
    }

    public function getDuration(): ?float
    {
        return $this->duration;
    }

    public function setCaller(?string $caller): static
    {
        $this->caller = $caller;

        return $this;
    }

    public function getCaller(): ?string
    {
        return $this->caller;
    }

    public function setCallee(?string $callee): static
    {
        $this->callee = $callee;

        return $this;
    }

    public function getCallee(): ?string
    {
        return $this->callee;
    }

    public function setRecorder(?string $recorder): static
    {
        $this->recorder = $recorder;

        return $this;
    }

    public function getRecorder(): ?string
    {
        return $this->recorder;
    }

    /**
     * @param int|null $id
     */
    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setRecordedFileFileSize(?int $recordedFileFileSize): static
    {
        $this->recordedFileFileSize = $recordedFileFileSize;

        return $this;
    }

    public function getRecordedFileFileSize(): ?int
    {
        return $this->recordedFileFileSize;
    }

    public function setRecordedFileMimeType(?string $recordedFileMimeType): static
    {
        $this->recordedFileMimeType = $recordedFileMimeType;

        return $this;
    }

    public function getRecordedFileMimeType(): ?string
    {
        return $this->recordedFileMimeType;
    }

    public function setRecordedFileBaseName(?string $recordedFileBaseName): static
    {
        $this->recordedFileBaseName = $recordedFileBaseName;

        return $this;
    }

    public function getRecordedFileBaseName(): ?string
    {
        return $this->recordedFileBaseName;
    }

    public function setUsersCdr(?UsersCdrDto $usersCdr): static
    {
        $this->usersCdr = $usersCdr;

        return $this;
    }

    public function getUsersCdr(): ?UsersCdrDto
    {
        return $this->usersCdr;
    }

    public function setUsersCdrId(?int $id): static
    {
        $value = !is_null($id)
            ? new UsersCdrDto($id)
            : null;

        return $this->setUsersCdr($value);
    }

    public function getUsersCdrId(): ?int
    {
        if ($dto = $this->getUsersCdr()) {
            return $dto->getId();
        }

        return null;
    }

    public function setCompany(?CompanyDto $company): static
    {
        $this->company = $company;

        return $this;
    }

    public function getCompany(): ?CompanyDto
    {
        return $this->company;
    }

    public function setCompanyId(?int $id): static
    {
        $value = !is_null($id)
            ? new CompanyDto($id)
            : null;

        return $this->setCompany($value);
    }

    public function getCompanyId(): ?int
    {
        if ($dto = $this->getCompany()) {
            return $dto->getId();
        }

        return null;
    }

    public function setDdi(?DdiDto $ddi): static
    {
        $this->ddi = $ddi;

        return $this;
    }

    public function getDdi(): ?DdiDto
    {
        return $this->ddi;
    }

    public function setDdiId(?int $id): static
    {
        $value = !is_null($id)
            ? new DdiDto($id)
            : null;

        return $this->setDdi($value);
    }

    public function getDdiId(): ?int
    {
        if ($dto = $this->getDdi()) {
            return $dto->getId();
        }

        return null;
    }

    public function setUser(?UserDto $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getUser(): ?UserDto
    {
        return $this->user;
    }

    public function setUserId(?int $id): static
    {
        $value = !is_null($id)
            ? new UserDto($id)
            : null;

        return $this->setUser($value);
    }

    public function getUserId(): ?int
    {
        if ($dto = $this->getUser()) {
            return $dto->getId();
        }

        return null;
    }
}
