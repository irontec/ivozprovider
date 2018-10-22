<?php

namespace Ivoz\Provider\Domain\Model\ResidentialDevice;

use Assert\Assertion;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;

/**
 * ResidentialDevice
 */
class ResidentialDevice extends ResidentialDeviceAbstract implements ResidentialDeviceInterface
{
    use ResidentialDeviceTrait;

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet()
    {
        $changeSet = parent::getChangeSet();
        if (isset($changeSet['password'])) {
            $changeSet['password'] = '****';
        }

        return $changeSet;
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
        $this->setBrand(
            $this
                ->getCompany()
                ->getBrand()
        );

        $this->setDomain(
            $this
                ->getCompany()
                ->getBrand()
                ->getDomain()
        );
    }

    /**
     * {@inheritDoc}
     */
    public function setName($name)
    {
        Assertion::regex($name, '/^[a-zA-Z0-9_*]+$/');
        return parent::setName($name);
    }

    /**
     * {@inheritDoc}
     */
    public function setIp($ip = null)
    {
        if (!empty($ip)) {
            Assertion::ip($ip);
        }
        return parent::setIp($ip);
    }

    /**
     * {@inheritDoc}
     */
    public function setPassword($password = null)
    {
        if (!empty($password)) {
            Assertion::regex(
                $password,
                '/^(?=.*[A-Z].*[A-Z].*[A-Z])(?=.*[+*_-])(?=.*[0-9].*[0-9].*[0-9])(?=.*[a-z].*[a-z].*[a-z]).{10,}$/'
            );
        }
        return parent::setPassword($password);
    }

    public function setPort($port = null)
    {
        if (!empty($port)) {
            Assertion::lessThan($port, pow(2, 16), 'port provided "%s" is not lower than "%s".');
        }

        return parent::setPort($port);
    }

    /**
     * @return string
     */
    public function getContact()
    {
        return sprintf(
            "sip:%s@%s",
            $this->getName(),
            $this->getDomain()
        );
    }

    /**
     * @return string
     */
    public function getSorcery()
    {
        return sprintf(
            "b%dc%dr%d_%s",
            $this->getCompany()->getBrand()->getId(),
            $this->getCompany()->getId(),
            $this->getId(),
            $this->getName()
        );
    }

    public function getAstPsEndpoint()
    {
        $psEndpoints = $this->getPsEndpoints();

        return array_shift($psEndpoints);
    }

    public function getLanguageCode()
    {
        $language = $this->getLanguage();
        if ($language) {
            return $language->getIden();
        }

        return $this->getCompany()->getLanguageCode();
    }

    /**
     * @return string
     */
    public function getOutgoingDdiNumber()
    {
        $ddi = $this->getOutgoingDdi();
        if ($ddi) {
            return $ddi->getDdiE164();
        }

        return null;
    }

    /**
     * Get Residential Device outgoingDdi
     * If no Ddi is assigned, retrieve company's default Ddi
     * @return \Ivoz\Provider\Domain\Model\Ddi\DdiInterface or NULL
     */
    public function getOutgoingDdi()
    {
        $ddi = parent::getOutgoingDdi();
        if (!is_null($ddi)) {
            return $ddi;
        }

        return $this
            ->getCompany()
            ->getOutgoingDdi();
    }

    /**
     * Get Ddi associated with this residential device
     *
     * @return DdiInterface
     */
    public function getDdi($ddieE164)
    {
        $criteria = new Criteria();

        if ($ddieE164) {
            $criteria->where(
                Criteria::expr()->eq(
                    'ddie164',
                    $ddieE164
                )
            );
        }

        $ddis = $this->getDdis($criteria);


        return array_shift($ddis);
    }

    /**
     * @return string with the voicemail
     */
    public function getVoiceMail()
    {
        return $this->getVoiceMailUser() . '@' . $this->getVoiceMailContext();
    }

    /**
     * @return string with the voicemail user
     */
    public function getVoiceMailUser()
    {
        return "residential" . $this->getId();
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
}
