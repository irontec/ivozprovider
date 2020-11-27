<?php

namespace Ivoz\Provider\Domain\Model\Terminal;

use Assert\Assertion;

/**
 * Terminal
 */
class Terminal extends TerminalAbstract implements TerminalInterface
{
    use TerminalTrait;

    /**
     * @return array
     */
    public function getChangeSet()
    {
        $response = parent::getChangeSet();
        unset($response['lastProvisionDate']);

        return $response;
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
        return sprintf(
            "%s [%s]",
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
     * @throws \InvalidArgumentException
     */
    public function setName(?string $name = null): self
    {
        if (!empty($name)) {
            Assertion::regex($name, '/^[a-zA-Z0-9_*]+$/');
        }

        return parent::setName($name);
    }

    /**
     * {@inheritDoc}
     * @throws \InvalidArgumentException
     */
    public function setPassword(string $password): self
    {
        Assertion::regex(
            $password,
            '/^(?=.*[A-Z].*[A-Z].*[A-Z])(?=.*[+*_-])(?=.*[0-9].*[0-9].*[0-9])(?=.*[a-z].*[a-z].*[a-z]).{10,}$/'
        );

        return parent::setPassword($password);
    }

    public function getUser()
    {
        $users = $this->getUsers();
        return array_shift(
            $users
        );
    }

    /**
     * @return string
     */
    public function getContact()
    {
        return sprintf(
            'sip:%s@%s',
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
            'b%dc%dt%d_%s',
            $this->getCompany()->getBrand()->getId(),
            $this->getCompany()->getId(),
            $this->getId(),
            $this->getName()
        );
    }

    /**
     * @return string
     */
    public function getAllow()
    {
        $allow_audio = $this->getAllowAudio();
        $allow_video = $this->getAllowVideo();

        if (!empty($allow_video)) {
            return $allow_audio . "," . $allow_video;
        }

        return $allow_audio;
    }

    /**
     * @return \Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface | null
     */
    public function getAstPsEndpoint()
    {
        $astPsEndpoints = $this->getAstPsEndpoints();

        return array_shift($astPsEndpoints);
    }

    public function setMac(?string $mac = null): self
    {
        if (!$mac) {
            $mac = null;
        }

        if (!is_null($mac)) {
            $mac = strtolower($mac);
            $mac = preg_replace(
                '/[^a-z0-9]/',
                '',
                $mac
            );
        }

        return parent::setMac($mac);
    }
}
