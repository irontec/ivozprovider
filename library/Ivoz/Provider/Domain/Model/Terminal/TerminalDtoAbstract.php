<?php

namespace Ivoz\Provider\Domain\Model\Terminal;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class TerminalDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var string
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
     * @var string
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
     * @var string
     */
    private $mac;

    /**
     * @var \DateTime
     */
    private $lastProvisionDate;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Ivoz\Provider\Domain\Model\Company\CompanyDto | null
     */
    private $company;

    /**
     * @var \Ivoz\Provider\Domain\Model\Domain\DomainDto | null
     */
    private $domain;

    /**
     * @var \Ivoz\Provider\Domain\Model\TerminalModel\TerminalModelDto | null
     */
    private $terminalModel;

    /**
     * @var \Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointDto[] | null
     */
    private $astPsEndpoints = null;

    /**
     * @var \Ivoz\Provider\Domain\Model\User\UserDto[] | null
     */
    private $users = null;


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
            'name' => 'name',
            'disallow' => 'disallow',
            'allowAudio' => 'allowAudio',
            'allowVideo' => 'allowVideo',
            'directMediaMethod' => 'directMediaMethod',
            'password' => 'password',
            'mac' => 'mac',
            'lastProvisionDate' => 'lastProvisionDate',
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
        return [
            'name' => $this->getName(),
            'disallow' => $this->getDisallow(),
            'allowAudio' => $this->getAllowAudio(),
            'allowVideo' => $this->getAllowVideo(),
            'directMediaMethod' => $this->getDirectMediaMethod(),
            'password' => $this->getPassword(),
            'mac' => $this->getMac(),
            'lastProvisionDate' => $this->getLastProvisionDate(),
            'id' => $this->getId(),
            'company' => $this->getCompany(),
            'domain' => $this->getDomain(),
            'terminalModel' => $this->getTerminalModel(),
            'astPsEndpoints' => $this->getAstPsEndpoints(),
            'users' => $this->getUsers()
        ];
    }

    /**
     * @param string $name
     *
     * @return static
     */
    public function setName($name = null)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
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
     * @param string $allowAudio
     *
     * @return static
     */
    public function setAllowAudio($allowAudio = null)
    {
        $this->allowAudio = $allowAudio;

        return $this;
    }

    /**
     * @return string
     */
    public function getAllowAudio()
    {
        return $this->allowAudio;
    }

    /**
     * @param string $allowVideo
     *
     * @return static
     */
    public function setAllowVideo($allowVideo = null)
    {
        $this->allowVideo = $allowVideo;

        return $this;
    }

    /**
     * @return string
     */
    public function getAllowVideo()
    {
        return $this->allowVideo;
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
     * @param string $mac
     *
     * @return static
     */
    public function setMac($mac = null)
    {
        $this->mac = $mac;

        return $this;
    }

    /**
     * @return string
     */
    public function getMac()
    {
        return $this->mac;
    }

    /**
     * @param \DateTime $lastProvisionDate
     *
     * @return static
     */
    public function setLastProvisionDate($lastProvisionDate = null)
    {
        $this->lastProvisionDate = $lastProvisionDate;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getLastProvisionDate()
    {
        return $this->lastProvisionDate;
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
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyDto $company
     *
     * @return static
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyDto $company = null)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyDto
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setCompanyId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Company\CompanyDto($id)
            : null;

        return $this->setCompany($value);
    }

    /**
     * @return integer | null
     */
    public function getCompanyId()
    {
        if ($dto = $this->getCompany()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Domain\DomainDto $domain
     *
     * @return static
     */
    public function setDomain(\Ivoz\Provider\Domain\Model\Domain\DomainDto $domain = null)
    {
        $this->domain = $domain;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Domain\DomainDto
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setDomainId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Domain\DomainDto($id)
            : null;

        return $this->setDomain($value);
    }

    /**
     * @return integer | null
     */
    public function getDomainId()
    {
        if ($dto = $this->getDomain()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\TerminalModel\TerminalModelDto $terminalModel
     *
     * @return static
     */
    public function setTerminalModel(\Ivoz\Provider\Domain\Model\TerminalModel\TerminalModelDto $terminalModel = null)
    {
        $this->terminalModel = $terminalModel;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\TerminalModel\TerminalModelDto
     */
    public function getTerminalModel()
    {
        return $this->terminalModel;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setTerminalModelId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\TerminalModel\TerminalModelDto($id)
            : null;

        return $this->setTerminalModel($value);
    }

    /**
     * @return integer | null
     */
    public function getTerminalModelId()
    {
        if ($dto = $this->getTerminalModel()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param array $astPsEndpoints
     *
     * @return static
     */
    public function setAstPsEndpoints($astPsEndpoints = null)
    {
        $this->astPsEndpoints = $astPsEndpoints;

        return $this;
    }

    /**
     * @return array
     */
    public function getAstPsEndpoints()
    {
        return $this->astPsEndpoints;
    }

    /**
     * @param array $users
     *
     * @return static
     */
    public function setUsers($users = null)
    {
        $this->users = $users;

        return $this;
    }

    /**
     * @return array
     */
    public function getUsers()
    {
        return $this->users;
    }
}
