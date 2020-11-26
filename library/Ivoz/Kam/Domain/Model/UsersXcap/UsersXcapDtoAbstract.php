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
     * @var 
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
     * @param  $doc | null
     *
     * @return static
     */
    public function setDoc(? $doc = null): self
    {
        $this->doc = $doc;

        return $this;
    }

    /**
     * @return  | null
     */
    public function getDoc()
    {
        return $this->doc;
    }

    /**
     * @param int $docType | null
     *
     * @return static
     */
    public function setDocType(?int $docType = null): self
    {
        $this->docType = $docType;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getDocType(): ?int
    {
        return $this->docType;
    }

    /**
     * @param string $etag | null
     *
     * @return static
     */
    public function setEtag(?string $etag = null): self
    {
        $this->etag = $etag;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getEtag(): ?string
    {
        return $this->etag;
    }

    /**
     * @param int $source | null
     *
     * @return static
     */
    public function setSource(?int $source = null): self
    {
        $this->source = $source;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getSource(): ?int
    {
        return $this->source;
    }

    /**
     * @param string $docUri | null
     *
     * @return static
     */
    public function setDocUri(?string $docUri = null): self
    {
        $this->docUri = $docUri;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDocUri(): ?string
    {
        return $this->docUri;
    }

    /**
     * @param int $port | null
     *
     * @return static
     */
    public function setPort(?int $port = null): self
    {
        $this->port = $port;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getPort(): ?int
    {
        return $this->port;
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
