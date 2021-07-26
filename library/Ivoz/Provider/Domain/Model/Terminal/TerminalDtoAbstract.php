<?php

namespace Ivoz\Provider\Domain\Model\Terminal;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use Ivoz\Provider\Domain\Model\Domain\DomainDto;
use Ivoz\Provider\Domain\Model\TerminalModel\TerminalModelDto;
use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointDto;
use Ivoz\Ast\Domain\Model\PsIdentify\PsIdentifyDto;
use Ivoz\Provider\Domain\Model\User\UserDto;

/**
* TerminalDtoAbstract
* @codeCoverageIgnore
*/
abstract class TerminalDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string
     */
    private $name = '';

    /**
     * @var string
     */
    private $disallow = 'all';

    /**
     * @var string
     */
    private $allowAudio = 'alaw';

    /**
     * @var string|null
     */
    private $allowVideo;

    /**
     * @var string
     */
    private $directMediaMethod = 'update';

    /**
     * @var string
     */
    private $password = '';

    /**
     * @var string|null
     */
    private $mac;

    /**
     * @var \DateTime|string|null
     */
    private $lastProvisionDate;

    /**
     * @var string
     */
    private $t38Passthrough = 'no';

    /**
     * @var bool
     */
    private $rtpEncryption = false;

    /**
     * @var int
     */
    private $id;

    /**
     * @var CompanyDto | null
     */
    private $company;

    /**
     * @var DomainDto | null
     */
    private $domain;

    /**
     * @var TerminalModelDto | null
     */
    private $terminalModel;

    /**
     * @var PsEndpointDto | null
     */
    private $psEndpoint;

    /**
     * @var PsIdentifyDto | null
     */
    private $psIdentify;

    /**
     * @var UserDto[] | null
     */
    private $users;

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
            'name' => 'name',
            'disallow' => 'disallow',
            'allowAudio' => 'allowAudio',
            'allowVideo' => 'allowVideo',
            'directMediaMethod' => 'directMediaMethod',
            'password' => 'password',
            'mac' => 'mac',
            'lastProvisionDate' => 'lastProvisionDate',
            't38Passthrough' => 't38Passthrough',
            'rtpEncryption' => 'rtpEncryption',
            'id' => 'id',
            'companyId' => 'company',
            'domainId' => 'domain',
            'terminalModelId' => 'terminalModel',
            'psEndpointId' => 'psEndpoint',
            'psIdentifyId' => 'psIdentify'
        ];
    }

    /**
    * @return array
    */
    public function toArray($hideSensitiveData = false)
    {
        $response = [
            'name' => $this->getName(),
            'disallow' => $this->getDisallow(),
            'allowAudio' => $this->getAllowAudio(),
            'allowVideo' => $this->getAllowVideo(),
            'directMediaMethod' => $this->getDirectMediaMethod(),
            'password' => $this->getPassword(),
            'mac' => $this->getMac(),
            'lastProvisionDate' => $this->getLastProvisionDate(),
            't38Passthrough' => $this->getT38Passthrough(),
            'rtpEncryption' => $this->getRtpEncryption(),
            'id' => $this->getId(),
            'company' => $this->getCompany(),
            'domain' => $this->getDomain(),
            'terminalModel' => $this->getTerminalModel(),
            'psEndpoint' => $this->getPsEndpoint(),
            'psIdentify' => $this->getPsIdentify(),
            'users' => $this->getUsers()
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

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setDisallow(?string $disallow): static
    {
        $this->disallow = $disallow;

        return $this;
    }

    public function getDisallow(): ?string
    {
        return $this->disallow;
    }

    public function setAllowAudio(?string $allowAudio): static
    {
        $this->allowAudio = $allowAudio;

        return $this;
    }

    public function getAllowAudio(): ?string
    {
        return $this->allowAudio;
    }

    public function setAllowVideo(?string $allowVideo): static
    {
        $this->allowVideo = $allowVideo;

        return $this;
    }

    public function getAllowVideo(): ?string
    {
        return $this->allowVideo;
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

    public function setPassword(?string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setMac(?string $mac): static
    {
        $this->mac = $mac;

        return $this;
    }

    public function getMac(): ?string
    {
        return $this->mac;
    }

    public function setLastProvisionDate(null|\DateTime|string $lastProvisionDate): static
    {
        $this->lastProvisionDate = $lastProvisionDate;

        return $this;
    }

    public function getLastProvisionDate(): \DateTime|string|null
    {
        return $this->lastProvisionDate;
    }

    public function setT38Passthrough(?string $t38Passthrough): static
    {
        $this->t38Passthrough = $t38Passthrough;

        return $this;
    }

    public function getT38Passthrough(): ?string
    {
        return $this->t38Passthrough;
    }

    public function setRtpEncryption(?bool $rtpEncryption): static
    {
        $this->rtpEncryption = $rtpEncryption;

        return $this;
    }

    public function getRtpEncryption(): ?bool
    {
        return $this->rtpEncryption;
    }

    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getId()
    {
        return $this->id;
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

    public function setDomain(?DomainDto $domain): static
    {
        $this->domain = $domain;

        return $this;
    }

    public function getDomain(): ?DomainDto
    {
        return $this->domain;
    }

    public function setDomainId($id): static
    {
        $value = !is_null($id)
            ? new DomainDto($id)
            : null;

        return $this->setDomain($value);
    }

    public function getDomainId()
    {
        if ($dto = $this->getDomain()) {
            return $dto->getId();
        }

        return null;
    }

    public function setTerminalModel(?TerminalModelDto $terminalModel): static
    {
        $this->terminalModel = $terminalModel;

        return $this;
    }

    public function getTerminalModel(): ?TerminalModelDto
    {
        return $this->terminalModel;
    }

    public function setTerminalModelId($id): static
    {
        $value = !is_null($id)
            ? new TerminalModelDto($id)
            : null;

        return $this->setTerminalModel($value);
    }

    public function getTerminalModelId()
    {
        if ($dto = $this->getTerminalModel()) {
            return $dto->getId();
        }

        return null;
    }

    public function setPsEndpoint(?PsEndpointDto $psEndpoint): static
    {
        $this->psEndpoint = $psEndpoint;

        return $this;
    }

    public function getPsEndpoint(): ?PsEndpointDto
    {
        return $this->psEndpoint;
    }

    public function setPsEndpointId($id): static
    {
        $value = !is_null($id)
            ? new PsEndpointDto($id)
            : null;

        return $this->setPsEndpoint($value);
    }

    public function getPsEndpointId()
    {
        if ($dto = $this->getPsEndpoint()) {
            return $dto->getId();
        }

        return null;
    }

    public function setPsIdentify(?PsIdentifyDto $psIdentify): static
    {
        $this->psIdentify = $psIdentify;

        return $this;
    }

    public function getPsIdentify(): ?PsIdentifyDto
    {
        return $this->psIdentify;
    }

    public function setPsIdentifyId($id): static
    {
        $value = !is_null($id)
            ? new PsIdentifyDto($id)
            : null;

        return $this->setPsIdentify($value);
    }

    public function getPsIdentifyId()
    {
        if ($dto = $this->getPsIdentify()) {
            return $dto->getId();
        }

        return null;
    }

    public function setUsers(?array $users): static
    {
        $this->users = $users;

        return $this;
    }

    public function getUsers(): ?array
    {
        return $this->users;
    }
}
