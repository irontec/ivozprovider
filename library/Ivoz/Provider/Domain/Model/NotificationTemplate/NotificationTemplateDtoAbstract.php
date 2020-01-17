<?php

namespace Ivoz\Provider\Domain\Model\NotificationTemplate;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class NotificationTemplateDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $type;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Ivoz\Provider\Domain\Model\Brand\BrandDto | null
     */
    private $brand;

    /**
     * @var \Ivoz\Provider\Domain\Model\NotificationTemplateContent\NotificationTemplateContentDto[] | null
     */
    private $contents = null;


    use DtoNormalizer;

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
            'type' => 'type',
            'id' => 'id',
            'brandId' => 'brand'
        ];
    }

    /**
     * @return array
     */
    public function toArray($hideSensitiveData = false)
    {
        return [
            'name' => $this->getName(),
            'type' => $this->getType(),
            'id' => $this->getId(),
            'brand' => $this->getBrand(),
            'contents' => $this->getContents()
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
     * @return string | null
     */
    public function getName()
    {
        return $this->name;
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
     * @return string | null
     */
    public function getType()
    {
        return $this->type;
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
     * @return integer | null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Brand\BrandDto $brand
     *
     * @return static
     */
    public function setBrand(\Ivoz\Provider\Domain\Model\Brand\BrandDto $brand = null)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandDto | null
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param mixed | null $id
     *
     * @return static
     */
    public function setBrandId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Brand\BrandDto($id)
            : null;

        return $this->setBrand($value);
    }

    /**
     * @return mixed | null
     */
    public function getBrandId()
    {
        if ($dto = $this->getBrand()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param array $contents
     *
     * @return static
     */
    public function setContents($contents = null)
    {
        $this->contents = $contents;

        return $this;
    }

    /**
     * @return array | null
     */
    public function getContents()
    {
        return $this->contents;
    }
}
