<?php

namespace Ivoz\Provider\Domain\Model\IvrCommon;

use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\Extension\Extension;
use Ivoz\Provider\Domain\Model\Locution\Locution;

/**
 * IvrCommon
 */
class IvrCommon extends IvrCommonAbstract implements IvrCommonInterface
{
    use IvrCommonTrait;

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
     * @return Locution[] with key=>value
     */
    public function getAllLocutions()
    {
        return [
            'welcome' => $this->getWelcomeLocution(),
            'noanswer' => $this->getNoAnswerLocution(),
            'error' => $this->getErrorLocution(),
            'success' => $this->getSuccessLocution(),
        ];
    }

    /**
     * @param Criteria $criteria
     * @return null|Extension
     */
    public function getExtension(Criteria $criteria = null)
    {
        return $this
            ->getExtensions($criteria)
            ->first();
    }
}

