<?php

namespace Ivoz\Provider\Domain\Model\Voicemail;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\User\UserDto;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceDto;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use Ivoz\Provider\Domain\Model\Locution\LocutionDto;
use Ivoz\Ast\Domain\Model\Voicemail\VoicemailDto;

/**
* VoicemailDtoAbstract
* @codeCoverageIgnore
*/
abstract class VoicemailDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var bool|null
     */
    private $enabled = true;

    /**
     * @var string|null
     */
    private $name = null;

    /**
     * @var string|null
     */
    private $email = null;

    /**
     * @var bool|null
     */
    private $sendMail = false;

    /**
     * @var bool|null
     */
    private $attachSound = true;

    /**
     * @var int|null
     */
    private $id = null;

    /**
     * @var UserDto | null
     */
    private $user = null;

    /**
     * @var ResidentialDeviceDto | null
     */
    private $residentialDevice = null;

    /**
     * @var CompanyDto | null
     */
    private $company = null;

    /**
     * @var LocutionDto | null
     */
    private $locution = null;

    /**
     * @var VoicemailDto | null
     */
    private $astVoicemail = null;

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
            'enabled' => 'enabled',
            'name' => 'name',
            'email' => 'email',
            'sendMail' => 'sendMail',
            'attachSound' => 'attachSound',
            'id' => 'id',
            'userId' => 'user',
            'residentialDeviceId' => 'residentialDevice',
            'companyId' => 'company',
            'locutionId' => 'locution',
            'astVoicemailId' => 'astVoicemail'
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(bool $hideSensitiveData = false): array
    {
        $response = [
            'enabled' => $this->getEnabled(),
            'name' => $this->getName(),
            'email' => $this->getEmail(),
            'sendMail' => $this->getSendMail(),
            'attachSound' => $this->getAttachSound(),
            'id' => $this->getId(),
            'user' => $this->getUser(),
            'residentialDevice' => $this->getResidentialDevice(),
            'company' => $this->getCompany(),
            'locution' => $this->getLocution(),
            'astVoicemail' => $this->getAstVoicemail()
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

    public function setEnabled(bool $enabled): static
    {
        $this->enabled = $enabled;

        return $this;
    }

    public function getEnabled(): ?bool
    {
        return $this->enabled;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setSendMail(bool $sendMail): static
    {
        $this->sendMail = $sendMail;

        return $this;
    }

    public function getSendMail(): ?bool
    {
        return $this->sendMail;
    }

    public function setAttachSound(bool $attachSound): static
    {
        $this->attachSound = $attachSound;

        return $this;
    }

    public function getAttachSound(): ?bool
    {
        return $this->attachSound;
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

    public function setUser(?UserDto $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getUser(): ?UserDto
    {
        return $this->user;
    }

    public function setUserId($id): static
    {
        $value = !is_null($id)
            ? new UserDto($id)
            : null;

        return $this->setUser($value);
    }

    public function getUserId()
    {
        if ($dto = $this->getUser()) {
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

    public function setCompany(?CompanyDto $company): static
    {
        $this->company = $company;

        return $this;
    }

    public function getCompany(): ?CompanyDto
    {
        return $this->company;
    }

    public function setCompanyId($id): static
    {
        $value = !is_null($id)
            ? new CompanyDto($id)
            : null;

        return $this->setCompany($value);
    }

    public function getCompanyId()
    {
        if ($dto = $this->getCompany()) {
            return $dto->getId();
        }

        return null;
    }

    public function setLocution(?LocutionDto $locution): static
    {
        $this->locution = $locution;

        return $this;
    }

    public function getLocution(): ?LocutionDto
    {
        return $this->locution;
    }

    public function setLocutionId($id): static
    {
        $value = !is_null($id)
            ? new LocutionDto($id)
            : null;

        return $this->setLocution($value);
    }

    public function getLocutionId()
    {
        if ($dto = $this->getLocution()) {
            return $dto->getId();
        }

        return null;
    }

    public function setAstVoicemail(?VoicemailDto $astVoicemail): static
    {
        $this->astVoicemail = $astVoicemail;

        return $this;
    }

    public function getAstVoicemail(): ?VoicemailDto
    {
        return $this->astVoicemail;
    }

    public function setAstVoicemailId($id): static
    {
        $value = !is_null($id)
            ? new VoicemailDto($id)
            : null;

        return $this->setAstVoicemail($value);
    }

    public function getAstVoicemailId()
    {
        if ($dto = $this->getAstVoicemail()) {
            return $dto->getId();
        }

        return null;
    }
}
