<?php

namespace Model\Dashboard;

use Ivoz\Api\Core\Annotation\AttributeDefinition;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDevice;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface;

/**
 * @codeCoverageIgnore
 */
class DashboardResidentialDevice
{
    /**
     * @var string
     * @AttributeDefinition(type="string")
     */
    protected $name;

    /**
     * @var string
     * @AttributeDefinition(type="string")
     */
    protected $outgoingDdi = '';

    /**
     * @var string
     * @AttributeDefinition(type="string")
     */
    protected $description;


    private function __construct(
        string $name,
        string $outgoingDdi,
        string $description
    ) {
        $this->name = $name;
        $this->outgoingDdi = $outgoingDdi;
        $this->description = $description;
    }

    public static function fromResidentialDevice(ResidentialDeviceInterface $residentialDevice): self
    {
        $name = $residentialDevice->getName();
        $outgoingDdi = $residentialDevice->getOutgoingDdi();
        $outgoingDdiToStr = is_null($outgoingDdi)
            ? ''
            : $outgoingDdi->getDdi();
        $description = $residentialDevice->getDescription();

        return new self(
            $name,
            $outgoingDdiToStr,
            $description
        );
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getOutgoingDdi(): string
    {
        return $this->outgoingDdi;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
}
