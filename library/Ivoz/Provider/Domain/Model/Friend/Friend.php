<?php

namespace Ivoz\Provider\Domain\Model\Friend;

use Assert\Assertion;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\CallAcl\CallAcl;
use Ivoz\Provider\Domain\Model\FriendsPattern\FriendsPattern;

/**
 * Friend
 */
class Friend extends FriendAbstract implements FriendInterface
{
    use FriendTrait;

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
        $this->setDomain(
            $this
                ->getCompany()
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
    public function setPort($port = null)
    {
        if (!empty($port)) {
            Assertion::regex($port, '/^[0-9]+$/');
            Assertion::lessThan($port, pow(2, 16), 'port provided "%s" is not lower than "%s".');
        }
        return parent::setPort($port);
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

    /**
     * @return string
     */
    public function getContact()
    {
        return sprintf("sip:%s@%s",
            $this->getName(),
            $this->getDomain());
    }

    /**
     * @return string
     */
    public function getSorcery()
    {
        return sprintf(
            "b%dc%df%d_%s",
            $this
                ->getCompany()
                ->getBrand()
                ->getId(),
            $this->getCompany()->getId(),
            $this->getId(),
            $this->getName()
        );
    }

    /**
     * @param $exten
     * @return bool
     */
    public function checkExtension($exten)
    {
        $patterns = $this->getPatterns();
        /**
         * @var FriendsPattern $pattern
         */
        foreach ($patterns as $pattern) {
            $regexp = '/' . $pattern->getRegExp() . '/';
            if (preg_match($regexp, $exten)) {

                return true;
            }
        }

        return false;
    }

    /**
     * @param string $exten
     * @return bool canCall
     */
    public function isAllowedToCall($exten)
    {
        /**
         * @var CallAcl $callAcl
         */
        $callAcl = $this->getCallAcl();
        if (empty($callAcl)) {
            return true;
        }
        return $callAcl->dstIsCallable($exten);
    }

    public function getRequestDirectUri($callee)
    {
        $uri = sprintf("sip:%s@%s", $callee, $this->getIp());

        // Check if the configured port is not the standard (5060)
        $port = $this->getPort();
        if (!is_null($port) && $port != 5060) {
            $uri .= ":$port";
        }

        // Check if the configured transport is not the standard (UDP)
        $transport = $this->getTransport();
        if ($transport != 'udp') {
            $uri .= ";transport=$transport";
        }

        return $uri;
    }

    /**
     * Obtain content for X-Info-Friend header
     *
     * @param called $number
     */
    public function getRequestUri($callee)
    {
        if ($this->getDirectConnectivity() == 'yes') {

            return $this->getRequestDirectUri($callee);
        } else {
            // Only Kamailio knows this!
            return 'dynamic';
        }
    }

    public function getAstPsEndpoint()
    {
        $astPsEnpoints = $this->getPsEndpoints(
            Criteria::create()->setMaxResults(1)
        );

        return current($astPsEnpoints);
    }


    public function getLanguageCode()
    {
        $language = $this->getLanguage();
        if (!$language) {

            return $this
                ->getCompany()
                ->getLanguageCode();
        }

        return $language->getIden();
    }

    /**
     * Get Friend outgoingDdi
     * If no Ddi is assigned, retrieve company's default Ddi
     */
    public function getOutgoingDdi()
    {
        $ddi = parent::getOutgoingDdi();
        if (empty($ddi)) {
            $ddi = $this
                ->getCompany()
                ->getOutgoingDdi();
        }

        return $ddi;
    }
}

