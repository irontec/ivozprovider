<?php

namespace Ivoz\Provider\Domain\Model\Contact;

/**
 * Contact
 */
class Contact extends ContactAbstract implements ContactInterface
{
    use ContactTrait;

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
     * @return void
     * @throws \Exception
     */
    protected function sanitizeValues()
    {
        // Set Work Phone in E.164 format
        $workPhoneCountry = $this->getWorkPhoneCountry();
        $workPhone = $this->getWorkPhone();
        $workPhoneE164 = ($workPhoneCountry && $workPhone)
            ? $workPhoneCountry->getCountryCode() . $workPhone
            : null;
        $this->setWorkPhoneE164($workPhoneE164);

        // Set Mobile Phone in E.164 format
        $mobilePhoneCountry = $this->getMobilePhoneCountry();
        $mobilePhone = $this->getMobilePhone();
        $mobilePhoneE164 = ($mobilePhoneCountry && $mobilePhone)
            ? $mobilePhoneCountry->getCountryCode() . $mobilePhone
            : null;
        $this->setMobilePhoneE164($mobilePhoneE164);
    }
}
