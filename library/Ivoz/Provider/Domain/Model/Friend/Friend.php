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
        $this->setDomain(
            $this
                ->getCompany()
                ->getDomain()
        );
    }

    /**
     * {@inheritDoc}
     * @see FriendAbstract::setName
     */
    public function setName($name)
    {
        Assertion::regex(
            $name,
            '/^[a-zA-Z0-9_*]+$/',
            'Friend.name value "%s" does not match expression.'
        );
        return parent::setName($name);
    }

    /**
     * {@inheritDoc}
     * @see FriendAbstract::setIp
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
     * @see FriendAbstract::setPort
     */
    public function setPort($port = null)
    {
        if (!empty($port)) {
            Assertion::regex((string) $port, '/^[0-9]+$/');
            Assertion::lessThan($port, pow(2, 16), 'Friend.port provided "%s" is not lower than "%s".');
        }
        return parent::setPort($port);
    }

    /**
     * {@inheritDoc}
     * @see FriendAbstract::setPassword
     */
    public function setPassword($password = null)
    {
        if (!empty($password)) {
            Assertion::regex(
                $password,
                '/^(?=.*[A-Z].*[A-Z].*[A-Z])(?=.*[+*_-])(?=.*[0-9].*[0-9].*[0-9])(?=.*[a-z].*[a-z].*[a-z]).{10,}$/',
                'Friend.password value "%s" does not match expression.'
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
     *
     * @return \Ivoz\Provider\Domain\Model\Ddi\DdiInterface
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

