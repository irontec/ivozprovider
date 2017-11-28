<?php
namespace Ivoz\Provider\Domain\Model\IvrEntry;

use Ivoz\Provider\Domain\Traits\RoutableTrait;

/**
 * IvrEntry
 */
class IvrEntry extends IvrEntryAbstract implements IvrEntryInterface
{
    use IvrEntryTrait;

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

