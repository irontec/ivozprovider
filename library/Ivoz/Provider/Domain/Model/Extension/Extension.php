<?php

namespace Ivoz\Provider\Domain\Model\Extension;

/**
 * Extension
 */
class Extension extends ExtensionAbstract implements ExtensionInterface
{
    use ExtensionTrait;

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

}

