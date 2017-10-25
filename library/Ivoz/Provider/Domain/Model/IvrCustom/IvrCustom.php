<?php
namespace Ivoz\Provider\Domain\Model\IvrCustom;
use Ivoz\Provider\Domain\Model\Locution\LocutionInterface;

/**
 * IvrCustom
 */
class IvrCustom extends IvrCustomAbstract implements IvrCustomInterface
{
    use IvrCustomTrait;

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
    public function getTimeoutNumberValueE164()
    {
        return
            $this->getTimeoutNumberCountry()->getCountryCode() .
            $this->getTimeoutNumberValue();
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
}

