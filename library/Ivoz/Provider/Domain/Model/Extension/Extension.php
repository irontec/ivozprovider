<?php

namespace Ivoz\Provider\Domain\Model\Extension;

use Assert\Assertion;
use Ivoz\Provider\Domain\Traits\RoutableTrait;
use \Ivoz\Provider\Domain\Model\User\UserInterface;

/**
 * Extension
 */
class Extension extends ExtensionAbstract implements ExtensionInterface
{
    use ExtensionTrait;
    use RoutableTrait;

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet()
    {
        return parent::getChangeSet();
    }

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Return string representation of this entity
     * @return string
     */
    public function __toString()
    {
        return sprintf(
            "%s [%s]",
            $this->getNumber(),
            parent::__toString()
        );
    }

    /**
     * {@inheritDoc}
     */
    protected function sanitizeValues()
    {
        $this->sanitizeRouteValues();
    }

    public function setUser(?UserInterface $user = null): static
    {
        return parent::setUser($user);
    }

    /**
     * {@inheritDoc}
     */
    public function setNumber(string $number): static
    {
        Assertion::regex($number, '/^[0-9].*$/');
        return parent::setNumber($number);
    }

    /**
     * {@inheritDoc}
     */
    public function setNumberValue(?string $numberValue = null): static
    {
        if (!empty($numberValue)) {
            Assertion::regex($numberValue, '/^[0-9]+$/');
        }
        return parent::setNumberValue($numberValue);
    }

    public function toArrayPortal()
    {
        return [
            'id' => $this->getId(),
            'number' => $this->getNumber()
        ];
    }

    /**
     * Get User using this Extension as ScreenExtension
     *
     * @return \Ivoz\Provider\Domain\Model\User\UserInterface|null
     */
    public function getScreenUser()
    {
        /** @var \Ivoz\Provider\Domain\Model\User\UserInterface[] $users */
        $users = $this->getUsers();

        return array_shift($users);
    }

    /**
     * Get the numberValue in E.164 format when routing to 'number'
     *
     * @return string
     */
    public function getNumberValueE164()
    {
        if (!$this->getNumberCountry()) {
            return "";
        }

        return
            $this->getNumberCountry()->getCountryCode() .
            $this->getNumberValue();
    }
}
