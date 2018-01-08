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

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet()
    {
        return parent::getChangeSet();
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

    /**
     * Return string representation of this entity
     * @return string
     */
    public function __toString()
    {
        return sprintf("%s [%s]",
            $this->getName(),
            parent::__toString()
        );
    }

    protected function sanitizeValues()
    {
        $this->sanitizeNoInputRouteType();
        $this->sanitizeErrorTargets();
    }

    protected function sanitizeNoInputRouteType()
    {
        $nullableFields =[
            'number' => 'noInputNumberValue',
            'extension' => 'noInputExtension',
            'voicemail' => 'noInputVoiceMailUser'
        ];

        $routeType = $this->getNoInputRouteType();
        foreach ($nullableFields as $type => $fieldName) {
            if ($routeType == $type) {
                continue;
            }
            $setter = 'set' . ucfirst($fieldName);
            $this->{$setter}(null);
        }
    }

    protected function sanitizeErrorTargets()
    {
        $nullableErrorFields = [
            'number' => 'errorNumberValue',
            'extension' => 'errorExtension',
            'voicemail' => 'errorVoiceMailUser'
        ];
        $routeErrorType = $this->getErrorRouteType();
        foreach ($nullableErrorFields as $type => $fieldName) {
            if ($routeErrorType == $type) {
                continue;
            }
            $setter = 'set' . ucfirst($fieldName);
            $this->{$setter}(null);
        }
    }

    /**
     * @return LocutionInterface[] with key=>value
     */
    public function getAllLocutions()
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

