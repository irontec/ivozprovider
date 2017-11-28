<?php
namespace Ivoz\Provider\Domain\Model\Ivr;

use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Provider\Domain\Model\Locution\LocutionInterface;
use Ivoz\Provider\Domain\Traits\RoutableTrait;

/**
 * Ivr
 */
class Ivr extends IvrAbstract implements IvrInterface
{
    use IvrTrait;

    use RoutableTrait { getTarget as protected; }

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
     * @return LocutionInterface[] with key=>value
     */
    public function getAllLocutions ()
    {
        return [
            'welcome' => $this->getWelcomeLocution(),
            'noanswer' => $this->getNoAnswerLocution(),
            'error' => $this->getErrorLocution(),
            'success' => $this->getSuccessLocution()
        ];
    }

    /**
     * Get the timeout numberValue in E.164 format when routing to 'number'
     *
     * @return string
     */
    public function getNoInputNumberValueE164()
    {
        return
            $this->getNoInputNumberCountry()->getCountryCode() .
            $this->getNoInputNumberValue();
    }

    /**
     * Get the error numberValue in E.164 format when routing to 'number'
     *
     * @return string
     */
    public function getErrorNumberValueE164()
    {
        return
            $this->getErrorNumberCountry()->getCountryCode() .
            $this->getErrorNumberValue();
    }

    public function getNoInputTarget()
    {
        return $this->getTarget("NoInput");
    }

    public function getErrorTarget()
    {
        return $this->getTarget("Error");
    }

}

