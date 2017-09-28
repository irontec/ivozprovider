<?php

namespace Ivoz\Kam\Domain\Model\TrunksAddres;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;

/**
 * TrunksAddresAbstract
 * @codeCoverageIgnore
 */
abstract class TrunksAddresAbstract
{
    /**
     * @var integer
     */
    protected $grp = '1';

    /**
     * @column ip_addr
     * @var string
     */
    protected $ipAddr;

    /**
     * @var integer
     */
    protected $mask = '32';

    /**
     * @var integer
     */
    protected $port = '0';

    /**
     * @var string
     */
    protected $tag;


    /**
     * Changelog tracking purpose
     * @var array
     */
    protected $_initialValues = [];

    /**
     * Constructor
     */
    public function __construct($grp, $mask, $port)
    {
        $this->setGrp($grp);
        $this->setMask($mask);
        $this->setPort($port);
    }

    /**
     * @param string $fieldName
     * @return mixed
     * @throws \Exception
     */
    public function initChangelog()
    {
        $this->_initialValues = $this->__toArray();
    }

    /**
     * @param string $fieldName
     * @return mixed
     * @throws \Exception
     */
    public function hasChanged($fieldName)
    {
        if (!array_key_exists($fieldName, $this->_initialValues)) {
            throw new \Exception($fieldName . ' field was not found');
        }
        $currentValues = $this->__toArray();

        return $currentValues[$fieldName] != $this->_initialValues[$fieldName];
    }

    public function getInitialValue($fieldName)
    {
        if (!array_key_exists($fieldName, $this->_initialValues)) {
            throw new \Exception($fieldName . ' field was not found');
        }

        return $this->_initialValues[$fieldName];
    }

    /**
     * @return TrunksAddresDTO
     */
    public static function createDTO()
    {
        return new TrunksAddresDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto TrunksAddresDTO
         */
        Assertion::isInstanceOf($dto, TrunksAddresDTO::class);

        $self = new static(
            $dto->getGrp(),
            $dto->getMask(),
            $dto->getPort());

        return $self
            ->setIpAddr($dto->getIpAddr())
            ->setTag($dto->getTag())
        ;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto TrunksAddresDTO
         */
        Assertion::isInstanceOf($dto, TrunksAddresDTO::class);

        $this
            ->setGrp($dto->getGrp())
            ->setIpAddr($dto->getIpAddr())
            ->setMask($dto->getMask())
            ->setPort($dto->getPort())
            ->setTag($dto->getTag());


        return $this;
    }

    /**
     * @return TrunksAddresDTO
     */
    public function toDTO()
    {
        return self::createDTO()
            ->setGrp($this->getGrp())
            ->setIpAddr($this->getIpAddr())
            ->setMask($this->getMask())
            ->setPort($this->getPort())
            ->setTag($this->getTag());
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'grp' => $this->getGrp(),
            'ipAddr' => $this->getIpAddr(),
            'mask' => $this->getMask(),
            'port' => $this->getPort(),
            'tag' => $this->getTag()
        ];
    }


    // @codeCoverageIgnoreStart

    /**
     * Set grp
     *
     * @param integer $grp
     *
     * @return self
     */
    public function setGrp($grp)
    {
        Assertion::notNull($grp);
        Assertion::integerish($grp);
        Assertion::greaterOrEqualThan($grp, 0);

        $this->grp = $grp;

        return $this;
    }

    /**
     * Get grp
     *
     * @return integer
     */
    public function getGrp()
    {
        return $this->grp;
    }

    /**
     * Set ipAddr
     *
     * @param string $ipAddr
     *
     * @return self
     */
    public function setIpAddr($ipAddr = null)
    {
        if (!is_null($ipAddr)) {
            Assertion::maxLength($ipAddr, 50);
        }

        $this->ipAddr = $ipAddr;

        return $this;
    }

    /**
     * Get ipAddr
     *
     * @return string
     */
    public function getIpAddr()
    {
        return $this->ipAddr;
    }

    /**
     * Set mask
     *
     * @param integer $mask
     *
     * @return self
     */
    public function setMask($mask)
    {
        Assertion::notNull($mask);
        Assertion::integerish($mask);

        $this->mask = $mask;

        return $this;
    }

    /**
     * Get mask
     *
     * @return integer
     */
    public function getMask()
    {
        return $this->mask;
    }

    /**
     * Set port
     *
     * @param integer $port
     *
     * @return self
     */
    public function setPort($port)
    {
        Assertion::notNull($port);
        Assertion::integerish($port);

        $this->port = $port;

        return $this;
    }

    /**
     * Get port
     *
     * @return integer
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * Set tag
     *
     * @param string $tag
     *
     * @return self
     */
    public function setTag($tag = null)
    {
        if (!is_null($tag)) {
            Assertion::maxLength($tag, 64);
        }

        $this->tag = $tag;

        return $this;
    }

    /**
     * Get tag
     *
     * @return string
     */
    public function getTag()
    {
        return $this->tag;
    }



    // @codeCoverageIgnoreEnd
}

