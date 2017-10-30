<?php
namespace Ivoz\Provider\Domain\Model\IvrCustomEntry;

/**
 * IvrCustomEntry
 */
class IvrCustomEntry extends IvrCustomEntryAbstract implements IvrCustomEntryInterface
{
    use IvrCustomEntryTrait;

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
}

