<?php

namespace Ivoz\Provider\Domain\Model\Terminal;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use Ivoz\Provider\Domain\Model\Domain\DomainDto;
use Ivoz\Provider\Domain\Model\TerminalModel\TerminalModelDto;
use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointDto;
use Ivoz\Provider\Domain\Model\User\UserDto;

/**
* TerminalDtoAbstract
* @codeCoverageIgnore
*/
abstract class TerminalDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string | null
     */
    private $name;

    /**
     * @var string
     */
    private $disallow = 'all';

    /**
     * @var string
     */
    private $allowAudio = 'alaw';

    /**
     * @var string | null
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
     * @var string | null
     */
    private $mac;

    /**
     * @var \DateTimeInterface | null
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
     * @var PsEndpointDto[] | null
     */
    private $astPsEndpoints;

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
            'terminalModelId' => 'terminalModel'
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
            'astPsEndpoints' => $this->getAstPsEndpoints(),
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

    /**
     * @param string $name | null
     *
     * @return static
     */
    public function setName(?string $name = null): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getName(): ?string
    {
        return $this->name;
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
     * @param string $allowAudio | null
     *
     * @return static
     */
    public function setAllowAudio(?string $allowAudio = null): self
    {
        $this->allowAudio = $allowAudio;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getAllowAudio(): ?string
    {
        return $this->allowAudio;
    }

    /**
     * @param string $allowVideo | null
     *
     * @return static
     */
    public function setAllowVideo(?string $allowVideo = null): self
    {
        $this->allowVideo = $allowVideo;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getAllowVideo(): ?string
    {
        return $this->allowVideo;
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
     * @param string $mac | null
     *
     * @return static
     */
    public function setMac(?string $mac = null): self
    {
        $this->mac = $mac;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getMac(): ?string
    {
        return $this->mac;
    }

    /**
     * @param \DateTimeInterface $lastProvisionDate | null
     *
     * @return static
     */
    public function setLastProvisionDate($lastProvisionDate = null): self
    {
        $this->lastProvisionDate = $lastProvisionDate;

        return $this;
    }

    /**
     * @return \DateTimeInterface | null
     */
    public function getLastProvisionDate()
    {
        return $this->lastProvisionDate;
    }

    /**
     * @param string $t38Passthrough | null
     *
     * @return static
     */
    public function setT38Passthrough(?string $t38Passthrough = null): self
    {
        $this->t38Passthrough = $t38Passthrough;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getT38Passthrough(): ?string
    {
        return $this->t38Passthrough;
    }

    /**
     * @param bool $rtpEncryption | null
     *
     * @return static
     */
    public function setRtpEncryption(?bool $rtpEncryption = null): self
    {
        $this->rtpEncryption = $rtpEncryption;

        return $this;
    }

    /**
     * @return bool | null
     */
    public function getRtpEncryption(): ?bool
    {
        return $this->rtpEncryption;
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
     * @param CompanyDto | null
     *
     * @return static
     */
    public function setCompany(?CompanyDto $company = null): self
    {
        $this->company = $company;

        return $this;
    }

    /**
     * @return CompanyDto | null
     */
    public function getCompany(): ?CompanyDto
    {
        return $this->company;
    }

    /**
     * @return static
     */
    public function setCompanyId($id): self
    {
        $value = !is_null($id)
            ? new CompanyDto($id)
            : null;

        return $this->setCompany($value);
    }

    /**
     * @return mixed | null
     */
    public function getCompanyId()
    {
        if ($dto = $this->getCompany()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param DomainDto | null
     *
     * @return static
     */
    public function setDomain(?DomainDto $domain = null): self
    {
        $this->domain = $domain;

        return $this;
    }

    /**
     * @return DomainDto | null
     */
    public function getDomain(): ?DomainDto
    {
        return $this->domain;
    }

    /**
     * @return static
     */
    public function setDomainId($id): self
    {
        $value = !is_null($id)
            ? new DomainDto($id)
            : null;

        return $this->setDomain($value);
    }

    /**
     * @return mixed | null
     */
    public function getDomainId()
    {
        if ($dto = $this->getDomain()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param TerminalModelDto | null
     *
     * @return static
     */
    public function setTerminalModel(?TerminalModelDto $terminalModel = null): self
    {
        $this->terminalModel = $terminalModel;

        return $this;
    }

    /**
     * @return TerminalModelDto | null
     */
    public function getTerminalModel(): ?TerminalModelDto
    {
        return $this->terminalModel;
    }

    /**
     * @return static
     */
    public function setTerminalModelId($id): self
    {
        $value = !is_null($id)
            ? new TerminalModelDto($id)
            : null;

        return $this->setTerminalModel($value);
    }

    /**
     * @return mixed | null
     */
    public function getTerminalModelId()
    {
        if ($dto = $this->getTerminalModel()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param PsEndpointDto[] | null
     *
     * @return static
     */
    public function setAstPsEndpoints(?array $astPsEndpoints = null): self
    {
        $this->astPsEndpoints = $astPsEndpoints;

        return $this;
    }

    /**
     * @return PsEndpointDto[] | null
     */
    public function getAstPsEndpoints(): ?array
    {
        return $this->astPsEndpoints;
    }

    /**
     * @param UserDto[] | null
     *
     * @return static
     */
    public function setUsers(?array $users = null): self
    {
        $this->users = $users;

        return $this;
    }

    /**
     * @return UserDto[] | null
     */
    public function getUsers(): ?array
    {
        return $this->users;
    }

}
