<?php

namespace Model\Dashboard;

use Ivoz\Api\Core\Annotation\AttributeDefinition;
use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;

/**
 * @codeCoverageIgnore
 */
class Dashboard
{
    /**
     * @var string
     * @AttributeDefinition(type="string")
     */
    protected $userName = '';

    /**
     * @var string
     * @AttributeDefinition(type="string")
     */
    protected $userLastName = '';

    /**
     * @var string
     * @AttributeDefinition(type="string")
     */
    protected $extension = '';


    /**
     * @var string
     * @AttributeDefinition(type="string")
     */
    protected $terminal = '';

    /**
     * @var string
     * @AttributeDefinition(type="string")
     */
    protected $email = '';

    /**
     * @var string
     * @AttributeDefinition(type="string")
     */
    protected $outgoingDdi = '';

    /**
     * @var string
     * @AttributeDefinition(type="string")
     */
    protected $productName;

    public function __construct(
        string $userName,
        string $userLastName,
        string $extension,
        string $terminal,
        string $email,
        string $outgoingDdi,
        string $productName = 'Ivoz Provider'
    ) {

        $this->userName = $userName;
        $this->userLastName = $userLastName;
        $this->extension = $extension;
        $this->terminal = $terminal;
        $this->email = $email;
        $this->outgoingDdi = $outgoingDdi;
        $this->productName = $productName;
    }

    public function getUserName(): string
    {
        return $this->userName;
    }

    public function getUserLastName(): string
    {
        return $this->userLastName;
    }

    public function getExtension(): string
    {
        return $this->extension;
    }

    public function getTerminal(): string
    {
        return $this->terminal;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getOutgoingDdi(): string
    {
        return $this->outgoingDdi;
    }

    public function getProductName(): string
    {
        return $this->productName;
    }
}
