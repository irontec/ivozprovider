<?php

namespace Ivoz\Provider\Domain\Model\Service;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class ServiceDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $iden = '';

    /**
     * @var string
     */
    private $defaultCode;

    /**
     * @var boolean
     */
    private $extraArgs = '0';

    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $nameEn = '';

    /**
     * @var string
     */
    private $nameEs = '';

    /**
     * @var string
     */
    private $descriptionEn = '';

    /**
     * @var string
     */
    private $descriptionEs = '';


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
            'iden' => 'iden',
            'defaultCode' => 'defaultCode',
            'extraArgs' => 'extraArgs',
            'id' => 'id',
            'name' => ['en','es'],
            'description' => ['en','es']
        ];
    }

    /**
     * @return array
     */
    public function toArray($hideSensitiveData = false)
    {
        return [
            'iden' => $this->getIden(),
            'defaultCode' => $this->getDefaultCode(),
            'extraArgs' => $this->getExtraArgs(),
            'id' => $this->getId(),
            'name' => [
                'en' => $this->getNameEn(),
                'es' => $this->getNameEs()
            ],
            'description' => [
                'en' => $this->getDescriptionEn(),
                'es' => $this->getDescriptionEs()
            ]
        ];
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
     * @param string $defaultCode
     *
     * @return static
     */
    public function setDefaultCode($defaultCode = null)
    {
        $this->defaultCode = $defaultCode;

        return $this;
    }

    /**
     * @return string
     */
    public function getDefaultCode()
    {
        return $this->defaultCode;
    }

    /**
     * @param boolean $extraArgs
     *
     * @return static
     */
    public function setExtraArgs($extraArgs = null)
    {
        $this->extraArgs = $extraArgs;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getExtraArgs()
    {
        return $this->extraArgs;
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
     * @param string $nameEn
     *
     * @return static
     */
    public function setNameEn($nameEn = null)
    {
        $this->nameEn = $nameEn;

        return $this;
    }

    /**
     * @return string
     */
    public function getNameEn()
    {
        return $this->nameEn;
    }

    /**
     * @param string $nameEs
     *
     * @return static
     */
    public function setNameEs($nameEs = null)
    {
        $this->nameEs = $nameEs;

        return $this;
    }

    /**
     * @return string
     */
    public function getNameEs()
    {
        return $this->nameEs;
    }

    /**
     * @param string $descriptionEn
     *
     * @return static
     */
    public function setDescriptionEn($descriptionEn = null)
    {
        $this->descriptionEn = $descriptionEn;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescriptionEn()
    {
        return $this->descriptionEn;
    }

    /**
     * @param string $descriptionEs
     *
     * @return static
     */
    public function setDescriptionEs($descriptionEs = null)
    {
        $this->descriptionEs = $descriptionEs;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescriptionEs()
    {
        return $this->descriptionEs;
    }
}
