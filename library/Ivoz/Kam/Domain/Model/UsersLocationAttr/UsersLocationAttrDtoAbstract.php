<?php

namespace Ivoz\Kam\Domain\Model\UsersLocationAttr;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
* UsersLocationAttrDtoAbstract
* @codeCoverageIgnore
*/
abstract class UsersLocationAttrDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string
     */
    private $ruid = '';

    /**
     * @var string
     */
    private $username = '';

    /**
     * @var string | null
     */
    private $domain;

    /**
     * @var string
     */
    private $aname = '';

    /**
     * @var int
     */
    private $atype = 0;

    /**
     * @var string
     */
    private $avalue = '';

    /**
     * @var \DateTimeInterface
     */
    private $lastModified = '1900-01-01 00:00:01';

    /**
     * @var int
     */
    private $id;

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
            'ruid' => 'ruid',
            'username' => 'username',
            'domain' => 'domain',
            'aname' => 'aname',
            'atype' => 'atype',
            'avalue' => 'avalue',
            'lastModified' => 'lastModified',
            'id' => 'id'
        ];
    }

    /**
    * @return array
    */
    public function toArray($hideSensitiveData = false)
    {
        $response = [
            'ruid' => $this->getRuid(),
            'username' => $this->getUsername(),
            'domain' => $this->getDomain(),
            'aname' => $this->getAname(),
            'atype' => $this->getAtype(),
            'avalue' => $this->getAvalue(),
            'lastModified' => $this->getLastModified(),
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

    /**
     * @param string $ruid | null
     *
     * @return static
     */
    public function setRuid(?string $ruid = null): self
    {
        $this->ruid = $ruid;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getRuid(): ?string
    {
        return $this->ruid;
    }

    /**
     * @param string $username | null
     *
     * @return static
     */
    public function setUsername(?string $username = null): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @param string $domain | null
     *
     * @return static
     */
    public function setDomain(?string $domain = null): self
    {
        $this->domain = $domain;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDomain(): ?string
    {
        return $this->domain;
    }

    /**
     * @param string $aname | null
     *
     * @return static
     */
    public function setAname(?string $aname = null): self
    {
        $this->aname = $aname;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getAname(): ?string
    {
        return $this->aname;
    }

    /**
     * @param int $atype | null
     *
     * @return static
     */
    public function setAtype(?int $atype = null): self
    {
        $this->atype = $atype;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getAtype(): ?int
    {
        return $this->atype;
    }

    /**
     * @param string $avalue | null
     *
     * @return static
     */
    public function setAvalue(?string $avalue = null): self
    {
        $this->avalue = $avalue;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getAvalue(): ?string
    {
        return $this->avalue;
    }

    /**
     * @param \DateTimeInterface $lastModified | null
     *
     * @return static
     */
    public function setLastModified($lastModified = null): self
    {
        $this->lastModified = $lastModified;

        return $this;
    }

    /**
     * @return \DateTimeInterface | null
     */
    public function getLastModified()
    {
        return $this->lastModified;
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

}
