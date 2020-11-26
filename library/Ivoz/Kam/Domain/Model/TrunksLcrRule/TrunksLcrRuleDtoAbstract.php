<?php

namespace Ivoz\Kam\Domain\Model\TrunksLcrRule;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternDto;
use Ivoz\Provider\Domain\Model\RoutingPatternGroupsRelPattern\RoutingPatternGroupsRelPatternDto;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingDto;

/**
* TrunksLcrRuleDtoAbstract
* @codeCoverageIgnore
*/
abstract class TrunksLcrRuleDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var int
     */
    private $lcrId = 1;

    /**
     * @var string | null
     */
    private $prefix;

    /**
     * @var string | null
     */
    private $fromUri;

    /**
     * @var string | null
     */
    private $requestUri;

    /**
     * @var string | null
     */
    private $mtTvalue;

    /**
     * @var int
     */
    private $stopper = 0;

    /**
     * @var int
     */
    private $enabled = 1;

    /**
     * @var int
     */
    private $id;

    /**
     * @var RoutingPatternDto | null
     */
    private $routingPattern;

    /**
     * @var RoutingPatternGroupsRelPatternDto | null
     */
    private $routingPatternGroupsRelPattern;

    /**
     * @var OutgoingRoutingDto | null
     */
    private $outgoingRouting;

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
            'lcrId' => 'lcrId',
            'prefix' => 'prefix',
            'fromUri' => 'fromUri',
            'requestUri' => 'requestUri',
            'mtTvalue' => 'mtTvalue',
            'stopper' => 'stopper',
            'enabled' => 'enabled',
            'id' => 'id',
            'routingPatternId' => 'routingPattern',
            'routingPatternGroupsRelPatternId' => 'routingPatternGroupsRelPattern',
            'outgoingRoutingId' => 'outgoingRouting'
        ];
    }

    /**
    * @return array
    */
    public function toArray($hideSensitiveData = false)
    {
        $response = [
            'lcrId' => $this->getLcrId(),
            'prefix' => $this->getPrefix(),
            'fromUri' => $this->getFromUri(),
            'requestUri' => $this->getRequestUri(),
            'mtTvalue' => $this->getMtTvalue(),
            'stopper' => $this->getStopper(),
            'enabled' => $this->getEnabled(),
            'id' => $this->getId(),
            'routingPattern' => $this->getRoutingPattern(),
            'routingPatternGroupsRelPattern' => $this->getRoutingPatternGroupsRelPattern(),
            'outgoingRouting' => $this->getOutgoingRouting()
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
     * @param int $lcrId | null
     *
     * @return static
     */
    public function setLcrId(?int $lcrId = null): self
    {
        $this->lcrId = $lcrId;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getLcrId(): ?int
    {
        return $this->lcrId;
    }

    /**
     * @param string $prefix | null
     *
     * @return static
     */
    public function setPrefix(?string $prefix = null): self
    {
        $this->prefix = $prefix;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getPrefix(): ?string
    {
        return $this->prefix;
    }

    /**
     * @param string $fromUri | null
     *
     * @return static
     */
    public function setFromUri(?string $fromUri = null): self
    {
        $this->fromUri = $fromUri;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getFromUri(): ?string
    {
        return $this->fromUri;
    }

    /**
     * @param string $requestUri | null
     *
     * @return static
     */
    public function setRequestUri(?string $requestUri = null): self
    {
        $this->requestUri = $requestUri;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getRequestUri(): ?string
    {
        return $this->requestUri;
    }

    /**
     * @param string $mtTvalue | null
     *
     * @return static
     */
    public function setMtTvalue(?string $mtTvalue = null): self
    {
        $this->mtTvalue = $mtTvalue;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getMtTvalue(): ?string
    {
        return $this->mtTvalue;
    }

    /**
     * @param int $stopper | null
     *
     * @return static
     */
    public function setStopper(?int $stopper = null): self
    {
        $this->stopper = $stopper;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getStopper(): ?int
    {
        return $this->stopper;
    }

    /**
     * @param int $enabled | null
     *
     * @return static
     */
    public function setEnabled(?int $enabled = null): self
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getEnabled(): ?int
    {
        return $this->enabled;
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

    /**
     * @param RoutingPatternDto | null
     *
     * @return static
     */
    public function setRoutingPattern(?RoutingPatternDto $routingPattern = null): self
    {
        $this->routingPattern = $routingPattern;

        return $this;
    }

    /**
     * @return RoutingPatternDto | null
     */
    public function getRoutingPattern(): ?RoutingPatternDto
    {
        return $this->routingPattern;
    }

    /**
     * @return static
     */
    public function setRoutingPatternId($id): self
    {
        $value = !is_null($id)
            ? new RoutingPatternDto($id)
            : null;

        return $this->setRoutingPattern($value);
    }

    /**
     * @return mixed | null
     */
    public function getRoutingPatternId()
    {
        if ($dto = $this->getRoutingPattern()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param RoutingPatternGroupsRelPatternDto | null
     *
     * @return static
     */
    public function setRoutingPatternGroupsRelPattern(?RoutingPatternGroupsRelPatternDto $routingPatternGroupsRelPattern = null): self
    {
        $this->routingPatternGroupsRelPattern = $routingPatternGroupsRelPattern;

        return $this;
    }

    /**
     * @return RoutingPatternGroupsRelPatternDto | null
     */
    public function getRoutingPatternGroupsRelPattern(): ?RoutingPatternGroupsRelPatternDto
    {
        return $this->routingPatternGroupsRelPattern;
    }

    /**
     * @return static
     */
    public function setRoutingPatternGroupsRelPatternId($id): self
    {
        $value = !is_null($id)
            ? new RoutingPatternGroupsRelPatternDto($id)
            : null;

        return $this->setRoutingPatternGroupsRelPattern($value);
    }

    /**
     * @return mixed | null
     */
    public function getRoutingPatternGroupsRelPatternId()
    {
        if ($dto = $this->getRoutingPatternGroupsRelPattern()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param OutgoingRoutingDto | null
     *
     * @return static
     */
    public function setOutgoingRouting(?OutgoingRoutingDto $outgoingRouting = null): self
    {
        $this->outgoingRouting = $outgoingRouting;

        return $this;
    }

    /**
     * @return OutgoingRoutingDto | null
     */
    public function getOutgoingRouting(): ?OutgoingRoutingDto
    {
        return $this->outgoingRouting;
    }

    /**
     * @return static
     */
    public function setOutgoingRoutingId($id): self
    {
        $value = !is_null($id)
            ? new OutgoingRoutingDto($id)
            : null;

        return $this->setOutgoingRouting($value);
    }

    /**
     * @return mixed | null
     */
    public function getOutgoingRoutingId()
    {
        if ($dto = $this->getOutgoingRouting()) {
            return $dto->getId();
        }

        return null;
    }

}
