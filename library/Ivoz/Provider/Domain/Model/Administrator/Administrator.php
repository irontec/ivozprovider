<?php

namespace Ivoz\Provider\Domain\Model\Administrator;


/**
 * Administrator
 */
class Administrator extends AdministratorAbstract implements AdministratorInterface
{
    use AdministratorTrait;

    /**
     * @return array
     */
    public function getChangeSet()
    {
        $changeSet = parent::getChangeSet();
        if (isset($changeSet['pass'])) {
            $changeSet['pass'] = '****';
        }

        return $changeSet;
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

}

