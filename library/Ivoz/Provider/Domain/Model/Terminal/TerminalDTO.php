<?php

namespace Ivoz\Provider\Domain\Model\Terminal;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;

/**
 * @codeCoverageIgnore
 */
class TerminalDTO implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $domain;

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
     * @var mixed
     */
    private $companyId;

    /**
     * @var mixed
     */
    private $terminalModelId;

    /**
     * @var mixed
     */
    private $company;

    /**
     * @var mixed
     */
    private $terminalModel;

    /**
     * @var array|null
     */
    private $astPsEndpoints = null;

    /**
     * @var array|null
     */
    private $users = null;

    /**
     * @return array
     */
    public function __toArray()
    {
        return [
            'name' => $this->getName(),
            'domain' => $this->getDomain(),
            'disallow' => $this->getDisallow(),
            'allowAudio' => $this->getAllowAudio(),
            'allowVideo' => $this->getAllowVideo(),
            'directMediaMethod' => $this->getDirectMediaMethod(),
            'password' => $this->getPassword(),
            'mac' => $this->getMac(),
            'lastProvisionDate' => $this->getLastProvisionDate(),
            'id' => $this->getId(),
            'companyId' => $this->getCompanyId(),
            'terminalModelId' => $this->getTerminalModelId(),
            'astPsEndpointsId' => $this->getAstPsEndpointsId(),
            'usersId' => $this->getUsersId()
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function transformForeignKeys(ForeignKeyTransformerInterface $transformer)
    {
        $this->company = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Company\\Company', $this->getCompanyId());
        $this->terminalModel = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\TerminalModel\\TerminalModel', $this->getTerminalModelId());
        if (!is_null($this->astPsEndpoints)) {
            $items = $this->getAstPsEndpoints();
            $this->astPsEndpoints = [];
            foreach ($items as $item) {
                $this->astPsEndpoints[] = $transformer->transform(
                    'Ivoz\\Ast\\Domain\\Model\\PsEndpoint\\PsEndpoint',
                    $item->getId() ?? $item
                );
            }
        }

        if (!is_null($this->users)) {
            $items = $this->getUsers();
            $this->users = [];
            foreach ($items as $item) {
                $this->users[] = $transformer->transform(
                    'Ivoz\\Provider\\Domain\\Model\\User\\User',
                    $item->getId() ?? $item
                );
            }
        }

    }

    /**
     * {@inheritDoc}
     */
    public function transformCollections(CollectionTransformerInterface $transformer)
    {
        $this->astPsEndpoints = $transformer->transform(
            'Ivoz\\Ast\\Domain\\Model\\PsEndpoint\\PsEndpoint',
            $this->astPsEndpoints
        );
        $this->users = $transformer->transform(
            'Ivoz\\Provider\\Domain\\Model\\User\\User',
            $this->users
        );
    }

    /**
     * @param string $name
     *
     * @return TerminalDTO
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
     * @param string $domain
     *
     * @return TerminalDTO
     */
    public function setDomain($domain = null)
    {
        $this->domain = $domain;

        return $this;
    }

    /**
     * @return string
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * @param string $disallow
     *
     * @return TerminalDTO
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
     * @param string $allowAudio
     *
     * @return TerminalDTO
     */
    public function setAllowAudio($allowAudio)
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
     * @return TerminalDTO
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
     * @return TerminalDTO
     */
    public function setDirectMediaMethod($directMediaMethod)
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
     * @return TerminalDTO
     */
    public function setPassword($password)
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
     * @return TerminalDTO
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
     * @return TerminalDTO
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
     * @return TerminalDTO
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
     * @param integer $companyId
     *
     * @return TerminalDTO
     */
    public function setCompanyId($companyId)
    {
        $this->companyId = $companyId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getCompanyId()
    {
        return $this->companyId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Company\Company
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param integer $terminalModelId
     *
     * @return TerminalDTO
     */
    public function setTerminalModelId($terminalModelId)
    {
        $this->terminalModelId = $terminalModelId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getTerminalModelId()
    {
        return $this->terminalModelId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\TerminalModel\TerminalModel
     */
    public function getTerminalModel()
    {
        return $this->terminalModel;
    }

    /**
     * @param array $astPsEndpoints
     *
     * @return TerminalDTO
     */
    public function setAstPsEndpoints($astPsEndpoints)
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
     * @return TerminalDTO
     */
    public function setUsers($users)
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

