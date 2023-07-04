<?php

namespace Model\Dashboard;

use Ivoz\Api\Core\Annotation\AttributeDefinition;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;

class DashboardAdmin
{
    /**
     * @var string
     * @AttributeDefinition(type="string")
     */
    protected $username;

    /**
     * @var string
     * @AttributeDefinition(type="string")
     */
    protected $name;

    /**
     * @var string
     * @AttributeDefinition(type="string")
     */
    protected $lastname;

    /**
     * @var string
     * @AttributeDefinition(type="string")
     */
    protected $email;

    public function __construct(
        string $username,
        string $name,
        string $lastname,
        string $email
    ) {
        $this->username = $username;
        $this->name = $name;
        $this->lastname = $lastname;
        $this->email = $email;
    }

    public static function fromAdministrator(
        AdministratorInterface $admin
    ): DashboardAdmin {
        $self = new self(
            $admin->getUsername(),
            $admin->getName() ?? '',
            $admin->getLastname() ?? '',
            $admin->getEmail()
        );

        return $self;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLastname(): string
    {
        return $this->lastname;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}
