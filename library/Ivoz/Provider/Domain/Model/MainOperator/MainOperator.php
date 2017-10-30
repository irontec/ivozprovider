<?php
namespace Ivoz\Provider\Domain\Model\MainOperator;

/**
 * MainOperator
 */
class MainOperator extends MainOperatorAbstract implements MainOperatorInterface
{
    use MainOperatorTrait;

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
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}

