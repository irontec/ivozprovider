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

    /**
     * Get the numberValue in E.164 format when routing to 'number'
     *
     * @return string
     */
    public function getNumberValueE164()
    {
        return
            $this->getTargetNumberCountry()->getCountryCode() .
            $this->getTargetNumberValue();
    }
}

