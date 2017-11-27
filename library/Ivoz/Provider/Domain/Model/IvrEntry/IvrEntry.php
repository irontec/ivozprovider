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

    protected function sanitizeValues()
    {
        $mustSanitize =
            empty($this->_initialValues)
            || $this->hasChanged('routeType');

        if ($mustSanitize) {
            switch($this->getRouteType())
            {
                case 'number':
                    $this->setExtension(null);
                    $this->setVoiceMailUser(null);
                    $this->setConditionalRoute(null);
                    break;
                case 'extension':
                    $this->setNumberValue(null);
                    $this->setVoiceMailUser(null);
                    $this->setConditionalRoute(null);
                    break;
                case 'voicemail':
                    $this->setNumberValue(null);
                    $this->setExtension(null);
                    $this->setConditionalRoute(null);
                    break;
                case 'conditional':
                    $this->setNumberValue(null);
                    $this->setExtension(null);
                    $this->setVoiceMailUser(null);
                    break;
            }
        }
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

