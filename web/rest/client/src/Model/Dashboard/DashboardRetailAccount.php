<?php

namespace Model\Dashboard;

use Ivoz\Api\Core\Annotation\AttributeDefinition;
use Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface;

/**
 * @codeCoverageIgnore
 */
class DashboardRetailAccount
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


    public function __construct(
        string $name,
        string $outgoingDdi,
        string $description
    ) {
        $this->name = $name;
        $this->outgoingDdi = $outgoingDdi;
        $this->description = $description;
    }

    public static function fromRetailAccount(RetailAccountInterface $retailAccount): self
    {
        $name = $retailAccount->getName();
        $outgoingDdi = $retailAccount->getOutgoingDdi();
        $outgoingDdiToStr = is_null($outgoingDdi)
            ? ''
            : $outgoingDdi->getDdi();
        $description = $retailAccount->getDescription();

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
