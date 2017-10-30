<?php

namespace Ivoz\Provider\Domain\Model\User;
use Ivoz\Provider\Domain\Model\PickUpRelUser\PickUpRelUserInterface;

/**
 * User
 */
class User extends UserAbstract implements UserInterface
{
    use UserTrait;

    public function getChangeSet()
    {
        $changeSet = parent::getChangeSet();
        if (isset($changeSet['pass'])) {
            $changeSet['pass'] = '****';
        }

        return $changeSet;
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
     * return associated endpoint with the user
     *
     * @return \Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface
     */
    public function getEndpoint()
    {
        $terminal = $this->getTerminal();
        if (!$terminal) {
            return null;
        }

        $endpoints = $terminal->getAstPsEndpoints();
        return array_shift($endpoints);
    }

    /**
     * @return string or null
     */
    public function getUserTerminalInterface()
    {
        $terminal = $this->getTerminal();
        if (empty($terminal)) {
            return null;
        }

        return $terminal->getName();
    }

    /**
     * @return string with the voicemail
     */
    public function getVoiceMail()
    {
        if (!is_null($this->getVoiceMailUser())) {
            return
                $this->getVoiceMailUser()
                . '@'
                . $this->getVoiceMailContext();
        }

        return '';
    }

    /**
     * @return string with the voicemail user
     */
    public function getVoiceMailUser()
    {
        return $this->getExtensionNumber();
    }

    /**
     * @return string with the voicemail context
     */
    public function getVoiceMailContext()
    {
        return
            'company'
            . $this->getCompany()->getId();
    }

    /**
     * @return string
     */
    public function getOutgoingDdiNumber()
    {
        $Ddi = $this->getOutgoingDdi();
        if ($Ddi) {

            return $Ddi->getDdiE164();
        }

        return null;
    }


    /**
     * Get User outgoingDdi
     * If no Ddi is assigned, retrieve company's default Ddi
     * @return \Ivoz\Provider\Domain\Model\Ddi\DdiInterface
     */
    public function getOutgoingDdi()
    {
        $ddi = parent::getOutgoingDdi();
        if ($ddi) {

            return $ddi;
        }

        return $this
            ->getCompany()
            ->getOutgoingDdi();
    }

    /**
     * Get User outgoingDdiRule
     * If no OutgoingDdiRule is assigned, retrieve company's default OutgoingDdiRule
     * @return \Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRuleInterface or null
     */
    public function getOutgoingDdiRule()
    {
        $outgoingDdiRule = parent::getOutgoingDdiRule();
        if ($outgoingDdiRule) {

            return $outgoingDdiRule;
        }

        return $this
            ->getCompany()
            ->getOutgoingDdiRule();
    }


    /**
     * @return string
     */
    public function getExtensionNumber()
    {
        $extension = $this->getExtension();
        if ($extension) {

            return $extension
                ->getNumber();
        }

        return '';
    }

    /**
     * @todo this is probably dead code
     * @return string or null
     */
    public function getDomain()
    {
        throw new \Exception('Review required');
        $company = $this->getCompany();
        if (!$company) {
            return null;
        }

        $brand = $company->getBrand();
        if (!$brand) {
            return null;
        }

        /**
         * @todo this does not exists
         */
        return $brand->getDomain();
    }

    /**
     * @param string $exten
     * @return bool canCall
     */
    public function isAllowedToCall($exten)
    {
        $callAcl = $this->getCallAcl();
        if (empty($callAcl)) {

            return true;
        }

        return $callAcl
            ->dstIsCallable($exten);
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\PickUpGroup\PickUpGroupInterface[]
     */
    public function getPickUpGroups()
    {
        $pickUpGroups = array();

        /**
         * @var PickUpRelUserInterface[] $pickUpRelUsers
         */
        $pickUpRelUsers = $this->getPickUpRelUsers();
        if (!empty($pickUpRelUsers)) {
            foreach ($pickUpRelUsers as $key => $pickUpRelUser) {
                $pickUpGroups[$key] = $pickUpRelUser->getPickUpGroup();
            }
        }

        return $pickUpGroups;
    }

    /**
     * @return string comma separated pickup group ids
     */
    public function getPickUpGroupsIds()
    {
        $pickUpGroupIds = array();

        /**
         * @var PickUpRelUserInterface[] $pickUpRelUsers
         */
        $pickUpRelUsers = $this->getPickUpRelUsers();
        if (!empty($pickUpRelUsers)) {
            foreach ($pickUpRelUsers as $pickUpRel) {
                array_push($pickUpGroupIds, $pickUpRel->getPickUpGroup()->getId());
            }
        }

        return join(',', $pickUpGroupIds);
    }

    /**
     * @return string
     */
    public function getFullName()
    {
        return
            $this->getName()
            . ' '
            . $this->getLastname();
    }

    /**
     * @return array
     */
    public function toArrayPortalForm()
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getFullName()
        ];
    }

    /**
     * @return bool
     */
    public function canBeCalled()
    {
        // Check if user is valid to be called
        if (!$this->getActive()) {
            return false;
        }

        // Check if user has terminal configured
        if (empty($this->getTerminal())) {
            return false;
        }

        // Check if user has extension configured
        if (empty($this->getExtension())) {
            return false;
        }

        // Looks like a complete user
        return true;
    }

    /**
     * Get user language
     * returns company language if wmpty
     * @return \Ivoz\Provider\Domain\Model\Language\LanguageInterface
     */
    public function getLanguage()
    {
        $language = parent::getLanguage();
        if ($language) {

            return $language;
        }

        return $this->getCompany()->getLanguage();
    }

    /**
     * Get User language code.
     * If not set, get the company language code
     * @return string
     */
    public function getLanguageCode()
    {
        return $this
            ->getLanguage()
            ->getIden();
    }

    /**
     * Get User country
     * return company country if empty
     * @return \Ivoz\Provider\Domain\Model\Country\CountryInterface
     */
    public function getCountry()
    {
        $country = parent::getCountry();
        if (!is_null($country)) {

            return $country;
        }

        return $this
            ->getCompany()
            ->getCountry();
    }

    /**
     * Convert a user dialed number to E164 form
     *
     * @param string $prefNumber
     * @return string number in E164
     */
    public function preferredToE164($prefNumber)
    {
        // Remove company outbound prefix
        $prefNumber = $this
            ->getCompany()
            ->removeOutboundPrefix($prefNumber);

        // Get user country
        $country = $this->getCountry();

        // Return e164 number dialed by this user
        return $country
            ->preferredToE164(
                $prefNumber,
                $this->getAreaCodeValue()
            );
    }

    /**
     * Convert a received number to User prefered format
     *
     * @param string $number
     */
    public function E164ToPreferred($e164number)
    {
        // Get User country
        $country = $this->getCountry();

        // Convert from E164 to user country preferred format
        $prefNumber = $country
            ->E164ToPreferred(
                $e164number,
                $this->getAreaCodeValue()
            );

        // Add Company outbound prefix
        return $this
            ->getCompany()
            ->addOutboundPrefix($prefNumber);
    }

    /**
     * Gets user Area Code. returns company area code if empty
     *
     * @return string
     */
    public function getAreaCodeValue()
    {
        $hasAreaCode = $this->getCountry()->hasAreaCode();
        if (!$hasAreaCode) {
            return '';
        }

        if (!empty($this->_areaCode)) {
            return $this->_areaCode;
        }

        return $this
            ->getCompany()
            ->getAreaCodeValue();
    }

}

