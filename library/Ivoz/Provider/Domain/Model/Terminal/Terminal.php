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
     * @codeCoverageIgnore
     * @return array<string, mixed>
     */
    public function getChangeSet(): array
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
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Return string representation of this entity
     * @return string
     */
    public function __toString(): string
    {
        return sprintf(
            "%s [%s]",
            $this->getName(),
            parent::__toString()
        );
    }

    protected function sanitizeValues(): void
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
        $password = trim($password);
        Assertion::regex(
            $password,
            '/^(?=.*[A-Z].*[A-Z].*[A-Z])(?=.*[+*_-])(?=.*[0-9].*[0-9].*[0-9])(?=.*[a-z].*[a-z].*[a-z]).{10,}$/'
        );

        return parent::setPassword($password);
    }

    public static function randomPassword(): string
    {
        $uppers = "ABCDEFGHJKLMNPQRSTUVWXYZ";
        $lowers = "abcdefghijkmnopqrstuvwxyz";
        $numbers = "1234567890";
        $symbols = '_-+*';

        $randStr = '';
        for ($i = 0; $i < 3; $i++) {
            $randStr .= $uppers[random_int(0, strlen($uppers) - 1)];
        }
        for ($i = 0; $i < 3; $i++) {
            $randStr .= $lowers[random_int(0, strlen($lowers) - 1)];
        }
        for ($i = 0; $i < 3; $i++) {
            $randStr .= $numbers[random_int(0, strlen($numbers) - 1)];
        }
        $randStr .= $symbols[random_int(0, strlen($symbols) - 1)];

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
    public function getContact(): string
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
    public function getSorcery(): string
    {
        return sprintf(
            'b%dc%dt%d_%s',
            (int) $this->getCompany()->getBrand()->getId(),
            (int) $this->getCompany()->getId(),
            (int) $this->getId(),
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
