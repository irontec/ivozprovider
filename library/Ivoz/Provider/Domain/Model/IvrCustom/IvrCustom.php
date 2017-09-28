<?php
namespace Ivoz\Provider\Domain\Model\IvrCustom;
use Ivoz\Provider\Domain\Model\Locution\LocutionInterface;

/**
 * IvrCustom
 */
class IvrCustom extends IvrCustomAbstract implements IvrCustomInterface
{
    use IvrCustomTrait;

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
}

