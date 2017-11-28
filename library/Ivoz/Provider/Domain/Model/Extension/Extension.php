<?php

namespace Ivoz\Provider\Domain\Model\Extension;

use Ivoz\Provider\Domain\Traits\RoutableTrait;

/**
 * Extension
 */
class Extension extends ExtensionAbstract implements ExtensionInterface
{
    use ExtensionTrait;

    use RoutableTrait;


    public function getChangeSet()
    {
        return parent::getChangeSet();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
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
        return
            $this->getNumberCountry()->getCountryCode() .
            $this->getNumberValue();
    }

}

