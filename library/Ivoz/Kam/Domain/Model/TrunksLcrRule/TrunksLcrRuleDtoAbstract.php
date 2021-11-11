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
     * @var int|null
     */
    private $lcrId = 1;

    /**
     * @var string|null
     */
    private $prefix = null;

    /**
     * @var string|null
     */
    private $fromUri = null;

    /**
     * @var string|null
     */
    private $requestUri = null;

    /**
     * @var string|null
     */
    private $mtTvalue = null;

    /**
     * @var int|null
     */
    private $stopper = 0;

    /**
     * @var int|null
     */
    private $enabled = 1;

    /**
     * @var int|null
     */
    private $id = null;

    /**
     * @var RoutingPatternDto | null
     */
    private $routingPattern = null;

    /**
     * @var RoutingPatternGroupsRelPatternDto | null
     */
    private $routingPatternGroupsRelPattern = null;

    /**
     * @var OutgoingRoutingDto | null
     */
    private $outgoingRouting = null;

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
     * @return array<string, mixed>
     */
    public function toArray(bool $hideSensitiveData = false): array
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

    public function setLcrId(int $lcrId): static
    {
        $this->lcrId = $lcrId;

        return $this;
    }

    public function getLcrId(): ?int
    {
        return $this->lcrId;
    }

    public function setPrefix(?string $prefix): static
    {
        $this->prefix = $prefix;

        return $this;
    }

    public function getPrefix(): ?string
    {
        return $this->prefix;
    }

    public function setFromUri(?string $fromUri): static
    {
        $this->fromUri = $fromUri;

        return $this;
    }

    public function getFromUri(): ?string
    {
        return $this->fromUri;
    }

    public function setRequestUri(?string $requestUri): static
    {
        $this->requestUri = $requestUri;

        return $this;
    }

    public function getRequestUri(): ?string
    {
        return $this->requestUri;
    }

    public function setMtTvalue(?string $mtTvalue): static
    {
        $this->mtTvalue = $mtTvalue;

        return $this;
    }

    public function getMtTvalue(): ?string
    {
        return $this->mtTvalue;
    }

    public function setStopper(int $stopper): static
    {
        $this->stopper = $stopper;

        return $this;
    }

    public function getStopper(): ?int
    {
        return $this->stopper;
    }

    public function setEnabled(int $enabled): static
    {
        $this->enabled = $enabled;

        return $this;
    }

    public function getEnabled(): ?int
    {
        return $this->enabled;
    }

    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setRoutingPattern(?RoutingPatternDto $routingPattern): static
    {
        $this->routingPattern = $routingPattern;

        return $this;
    }

    public function getRoutingPattern(): ?RoutingPatternDto
    {
        return $this->routingPattern;
    }

    public function setRoutingPatternId($id): static
    {
        $value = !is_null($id)
            ? new RoutingPatternDto($id)
            : null;

        return $this->setRoutingPattern($value);
    }

    public function getRoutingPatternId()
    {
        if ($dto = $this->getRoutingPattern()) {
            return $dto->getId();
        }

        return null;
    }

    public function setRoutingPatternGroupsRelPattern(?RoutingPatternGroupsRelPatternDto $routingPatternGroupsRelPattern): static
    {
        $this->routingPatternGroupsRelPattern = $routingPatternGroupsRelPattern;

        return $this;
    }

    public function getRoutingPatternGroupsRelPattern(): ?RoutingPatternGroupsRelPatternDto
    {
        return $this->routingPatternGroupsRelPattern;
    }

    public function setRoutingPatternGroupsRelPatternId($id): static
    {
        $value = !is_null($id)
            ? new RoutingPatternGroupsRelPatternDto($id)
            : null;

        return $this->setRoutingPatternGroupsRelPattern($value);
    }

    public function getRoutingPatternGroupsRelPatternId()
    {
        if ($dto = $this->getRoutingPatternGroupsRelPattern()) {
            return $dto->getId();
        }

        return null;
    }

    public function setOutgoingRouting(?OutgoingRoutingDto $outgoingRouting): static
    {
        $this->outgoingRouting = $outgoingRouting;

        return $this;
    }

    public function getOutgoingRouting(): ?OutgoingRoutingDto
    {
        return $this->outgoingRouting;
    }

    public function setOutgoingRoutingId($id): static
    {
        $value = !is_null($id)
            ? new OutgoingRoutingDto($id)
            : null;

        return $this->setOutgoingRouting($value);
    }

    public function getOutgoingRoutingId()
    {
        if ($dto = $this->getOutgoingRouting()) {
            return $dto->getId();
        }

        return null;
    }
}
