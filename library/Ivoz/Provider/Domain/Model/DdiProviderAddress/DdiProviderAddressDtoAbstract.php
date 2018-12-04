<?php

namespace Ivoz\Provider\Domain\Model\DdiProviderAddress;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class DdiProviderAddressDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $ip;

    /**
     * @var string
     */
    private $description;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Ivoz\Kam\Domain\Model\TrunksAddress\TrunksAddressDto | null
     */
    private $trunksAddress;

    /**
     * @var \Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderDto | null
     */
    private $ddiProvider;


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
            'ip' => 'ip',
            'description' => 'description',
            'id' => 'id',
            'trunksAddressId' => 'trunksAddress',
            'ddiProviderId' => 'ddiProvider'
        ];
    }

    /**
     * @return array
     */
    public function toArray($hideSensitiveData = false)
    {
        return [
            'ip' => $this->getIp(),
            'description' => $this->getDescription(),
            'id' => $this->getId(),
            'trunksAddress' => $this->getTrunksAddress(),
            'ddiProvider' => $this->getDdiProvider()
        ];
    }

    /**
     * @param string $ip
     *
     * @return static
     */
    public function setIp($ip = null)
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @param string $description
     *
     * @return static
     */
    public function setDescription($description = null)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
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
     * @param \Ivoz\Kam\Domain\Model\TrunksAddress\TrunksAddressDto $trunksAddress
     *
     * @return static
     */
    public function setTrunksAddress(\Ivoz\Kam\Domain\Model\TrunksAddress\TrunksAddressDto $trunksAddress = null)
    {
        $this->trunksAddress = $trunksAddress;

        return $this;
    }

    /**
     * @return \Ivoz\Kam\Domain\Model\TrunksAddress\TrunksAddressDto
     */
    public function getTrunksAddress()
    {
        return $this->trunksAddress;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setTrunksAddressId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Kam\Domain\Model\TrunksAddress\TrunksAddressDto($id)
            : null;

        return $this->setTrunksAddress($value);
    }

    /**
     * @return integer | null
     */
    public function getTrunksAddressId()
    {
        if ($dto = $this->getTrunksAddress()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderDto $ddiProvider
     *
     * @return static
     */
    public function setDdiProvider(\Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderDto $ddiProvider = null)
    {
        $this->ddiProvider = $ddiProvider;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderDto
     */
    public function getDdiProvider()
    {
        return $this->ddiProvider;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setDdiProviderId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderDto($id)
            : null;

        return $this->setDdiProvider($value);
    }

    /**
     * @return integer | null
     */
    public function getDdiProviderId()
    {
        if ($dto = $this->getDdiProvider()) {
            return $dto->getId();
        }

        return null;
    }
}
