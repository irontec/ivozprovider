<?php

namespace Ivoz\Kam\Domain\Model\UsersXcap;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
* UsersXcapDtoAbstract
* @codeCoverageIgnore
*/
abstract class UsersXcapDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $domain;

    /**
     * @var string
     */
    private $doc;

    /**
     * @var int
     */
    private $docType;

    /**
     * @var string
     */
    private $etag;

    /**
     * @var int
     */
    private $source;

    /**
     * @var string
     */
    private $docUri;

    /**
     * @var int
     */
    private $port;

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
            'username' => 'username',
            'domain' => 'domain',
            'doc' => 'doc',
            'docType' => 'docType',
            'etag' => 'etag',
            'source' => 'source',
            'docUri' => 'docUri',
            'port' => 'port',
            'id' => 'id'
        ];
    }

    /**
    * @return array
    */
    public function toArray($hideSensitiveData = false)
    {
        $response = [
            'username' => $this->getUsername(),
            'domain' => $this->getDomain(),
            'doc' => $this->getDoc(),
            'docType' => $this->getDocType(),
            'etag' => $this->getEtag(),
            'source' => $this->getSource(),
            'docUri' => $this->getDocUri(),
            'port' => $this->getPort(),
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

    public function setUsername(?string $username): static
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

    public function setDoc(?string $doc): static
    {
        $this->doc = $doc;

        return $this;
    }

    public function getDoc(): ?string
    {
        return $this->doc;
    }

    public function setDocType(?int $docType): static
    {
        $this->docType = $docType;

        return $this;
    }

    public function getDocType(): ?int
    {
        return $this->docType;
    }

    public function setEtag(?string $etag): static
    {
        $this->etag = $etag;

        return $this;
    }

    public function getEtag(): ?string
    {
        return $this->etag;
    }

    public function setSource(?int $source): static
    {
        $this->source = $source;

        return $this;
    }

    public function getSource(): ?int
    {
        return $this->source;
    }

    public function setDocUri(?string $docUri): static
    {
        $this->docUri = $docUri;

        return $this;
    }

    public function getDocUri(): ?string
    {
        return $this->docUri;
    }

    public function setPort(?int $port): static
    {
        $this->port = $port;

        return $this;
    }

    public function getPort(): ?int
    {
        return $this->port;
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
}
