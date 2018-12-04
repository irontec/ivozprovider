<?php

namespace Ivoz\Provider\Domain\Model\Codec;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class CodecDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $type = 'audio';

    /**
     * @var string
     */
    private $iden;

    /**
     * @var string
     */
    private $name;

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
            'type' => 'type',
            'iden' => 'iden',
            'name' => 'name',
            'id' => 'id'
        ];
    }

    /**
     * @return array
     */
    public function toArray($hideSensitiveData = false)
    {
        return [
            'type' => $this->getType(),
            'iden' => $this->getIden(),
            'name' => $this->getName(),
            'id' => $this->getId()
        ];
    }

    /**
     * @param string $type
     *
     * @return static
     */
    public function setType($type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $iden
     *
     * @return static
     */
    public function setIden($iden = null)
    {
        $this->iden = $iden;

        return $this;
    }

    /**
     * @return string
     */
    public function getIden()
    {
        return $this->iden;
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
