<?php

namespace Model\Dashboard;

use Ivoz\Api\Core\Annotation\AttributeDefinition;
use Ivoz\Provider\Domain\Model\User\UserInterface;

/**
 * @codeCoverageIgnore
 */
class DashboardUser
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
    protected $lastName;

    /**
     * @var string
     * @AttributeDefinition(type="string")
     */
    protected $extension = '';

    /**
     * @var string
     * @AttributeDefinition(type="string")
     */
    protected $outgoingDdi = '';

    private function __construct(
        string $name,
        string $lastName,
        string $extension,
        string $outgoingDdi,
    ) {
        $this->name = $name;
        $this->lastName = $lastName;
        $this->extension = $extension;
        $this->outgoingDdi = $outgoingDdi;
    }

    public static function fromUser(UserInterface $user): self
    {

        $name = $user->getName();
        $lastName = $user->getLastName();
        $extension = $user->getExtension();
        $extensionToStr = is_null($extension)
            ? ''
            : $extension->getNumber();
        $outgoingDdi = $user->getOutgoingDdi();
        $outgoingDdiToStr = is_null($outgoingDdi)
            ? ''
            : $outgoingDdi->getDdi();

        return new self(
            $name,
            $lastName,
            $extensionToStr,
            $outgoingDdiToStr,
        );
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getExtension(): string
    {
        return $this->extension;
    }

    public function getOutgoingDdi(): string
    {
        return $this->outgoingDdi;
    }
}
