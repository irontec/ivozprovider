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
    public function setName(?string $name = null): static
    {
        if (! is_null($name)) {
            Assertion::regex($name, '/^[a-zA-Z0-9_*]+$/');
        }

        return parent::setName($name);
    }

    /**
     * {@inheritDoc}
     * @throws \InvalidArgumentException
     */
    public function setPassword(string $password): static
    {
        Assertion::regex(
            $password,
            '/^(?=.*[A-Z].*[A-Z].*[A-Z])(?=.*[+*_-])(?=.*[0-9].*[0-9].*[0-9])(?=.*[a-z].*[a-z].*[a-z]).{10,}$/'
        );

        return parent::setPassword($password);
    }

    public static function randomPassword()
    {
        $uppers = "ABCDEFGHJKLMNPQRSTUVWXYZ";
        $lowers = "abcdefghijkmnopqrstuvwxyz";
        $numbers = "1234567890";
        $symbols = '_-+*';

        $randStr = '';
        for ($i = 0; $i < 3; $i++) {
            $randStr .= $uppers[rand(0, strlen($uppers) - 1)];
        }
        for ($i = 0; $i < 3; $i++) {
            $randStr .= $lowers[rand(0, strlen($lowers) - 1)];
        }
        for ($i = 0; $i < 3; $i++) {
            $randStr .= $numbers[rand(0, strlen($numbers) - 1)];
        }
        $randStr.= $symbols[rand(0, strlen($symbols) - 1)];

        return str_shuffle($randStr);
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

    public function setMac(?string $mac = null): static
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
