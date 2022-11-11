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
     * @var string|null
     */
    private $ruid = '';

    /**
     * @var string|null
     */
    private $username = '';

    /**
     * @var string|null
     */
    private $domain = null;

    /**
     * @var string|null
     */
    private $aname = '';

    /**
     * @var int|null
     */
    private $atype = 0;

    /**
     * @var string|null
     */
    private $avalue = '';

    /**
     * @var \DateTimeInterface|string|null
     */
    private $lastModified = '1900-01-01 00:00:01';

    /**
     * @var string|null
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
     * @return array<string, mixed>
     */
    public function toArray(bool $hideSensitiveData = false): array
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

    public function setRuid(string $ruid): static
    {
        $this->ruid = $ruid;

        return $this;
    }

    public function getRuid(): ?string
    {
        return $this->ruid;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setDomain(?string $domain): static
    {
        $this->domain = $domain;

        return $this;
    }

    public function getDomain(): ?string
    {
        return $this->domain;
    }

    public function setAname(string $aname): static
    {
        $this->aname = $aname;

        return $this;
    }

    public function getAname(): ?string
    {
        return $this->aname;
    }

    public function setAtype(int $atype): static
    {
        $this->atype = $atype;

        return $this;
    }

    public function getAtype(): ?int
    {
        return $this->atype;
    }

    public function setAvalue(string $avalue): static
    {
        $this->avalue = $avalue;

        return $this;
    }

    public function getAvalue(): ?string
    {
        return $this->avalue;
    }

    public function setLastModified(\DateTimeInterface|string $lastModified): static
    {
        $this->lastModified = $lastModified;

        return $this;
    }

    public function getLastModified(): \DateTimeInterface|string|null
    {
        return $this->lastModified;
    }

    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): ?string
    {
        return $this->id;
    }
}
