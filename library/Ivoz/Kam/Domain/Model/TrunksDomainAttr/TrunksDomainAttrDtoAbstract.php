<?php

namespace Ivoz\Kam\Domain\Model\TrunksDomainAttr;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class TrunksDomainAttrDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $did;

    /**
     * @var string
     */
    private $name;

    /**
     * @var integer
     */
    private $type;

    /**
     * @var string
     */
    private $value;

    /**
     * @var \DateTime
     */
    private $lastModified = '1900-01-01 00:00:01';

    /**
     * @var integer
     */
    private $id;


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
            'did' => 'did',
            'name' => 'name',
            'type' => 'type',
            'value' => 'value',
            'lastModified' => 'lastModified',
            'id' => 'id'
        ];
    }

    /**
     * @return array
     */
    public function toArray($hideSensitiveData = false)
    {
        return [
            'did' => $this->getDid(),
            'name' => $this->getName(),
            'type' => $this->getType(),
            'value' => $this->getValue(),
            'lastModified' => $this->getLastModified(),
            'id' => $this->getId()
        ];
    }

    /**
     * @param string $did
     *
     * @return static
     */
    public function setDid($did = null)
    {
        $this->did = $did;

        return $this;
    }

    /**
     * @return string
     */
    public function getDid()
    {
        return $this->did;
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
     * @param integer $type
     *
     * @return static
     */
    public function setType($type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return integer
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $value
     *
     * @return static
     */
    public function setValue($value = null)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param \DateTime $lastModified
     *
     * @return static
     */
    public function setLastModified($lastModified = null)
    {
        $this->lastModified = $lastModified;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getLastModified()
    {
        return $this->lastModified;
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
}
