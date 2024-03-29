<?php

namespace Helpers;

use Assert\Assertion;
use Doctrine\ORM\EntityManagerInterface;
use Ivoz\Provider\Domain\Model\Domain\Domain;
use Ivoz\Provider\Domain\Model\Terminal\Terminal;

class EndpointResolver
{
    /**
     * @var EntityManagerInterface
     */
    protected $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @param string $endpointName
     * @return \Ivoz\Provider\Domain\Model\User\UserInterface
     * @throws \InvalidArgumentException
     */
    public function getUserFromEndpoint($endpointName)
    {
        $endpoint = $this->getEndpointFromName($endpointName);

        Assertion::notNull(
            $endpoint,
            sprintf('No endpoint found for "%s".', $endpointName)
        );

        /** @var \Ivoz\Provider\Domain\Model\Terminal\TerminalInterface $terminal */
        $terminal = $endpoint->getTerminal();

        Assertion::notNull(
            $terminal,
            sprintf('Endpoint "%s" has no terminal associated.', $endpointName)
        );

        /** @var \Ivoz\Provider\Domain\Model\User\UserInterface $user */
        $user = $terminal->getUser();

        Assertion::notNull(
            $user,
            sprintf('Terminal "%s" has no user associated.', $terminal)
        );

        /** @var \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface $extension */
        $extension = $user->getExtension();

        Assertion::notNull(
            $extension,
            sprintf('User "%s" has no extension associated.', $user)
        );

        return $user;
    }

    /**
     * @param string $endpointName
     * @return \Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface
     */
    public function getEndpointFromName($endpointName)
    {
        /** @var \Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointRepository $endpointRepository */
        $endpointRepository = $this->em->getRepository('Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpoint');

        /** @var \Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface $endpoint */
        $endpoint = $endpointRepository->findOneBySorceryId($endpointName);

        return $endpoint;
    }

    /**
     * @param string $endpointNum
     * @param string $endpointDomain
     * @return string
     * @throws \InvalidArgumentException
     */
    public function getEndpointNameFromContact($endpointNum, $endpointDomain)
    {
        /** @var \Ivoz\Provider\Domain\Model\Domain\DomainRepository $domainRepository */
        $domainRepository = $this->em->getRepository(Domain::class);
        $domain = $domainRepository->findOneByDomain($endpointDomain);

        Assertion::notNull(
            $domain,
            sprintf('No Domain found for "%s".', $endpointDomain)
        );

        /** @var \Ivoz\Provider\Domain\Model\Terminal\TerminalRepository $terminalRepository */
        $terminalRepository = $this->em->getRepository(Terminal::class);
        /** @var \Ivoz\Provider\Domain\Model\Terminal\TerminalInterface $terminal */
        $terminal = $terminalRepository->findOneByNameAndDomain(
            $endpointNum,
            $domain
        );

        Assertion::notNull(
            $terminal,
            sprintf('No Terminal found for "%s@%s"', $endpointNum, $endpointDomain)
        );

        /** @var \Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface $endpoint */
        $endpoint = $terminal->getPsEndpoint();
        Assertion::notNull(
            $endpoint,
            sprintf('No endpoint found for "%s".', $endpointNum)
        );

        // Get the endpoint name matching the referer contact
        return $endpoint->getSorceryId();
    }

    /**
     * @param string $endpointName
     * @return \Ivoz\Provider\Domain\Model\Friend\FriendInterface|null
     * @throws \InvalidArgumentException
     */
    public function getFriendFromEndpoint($endpointName)
    {
        $endpoint = $this->getEndpointFromName($endpointName);

        Assertion::notNull(
            $endpoint,
            sprintf('No endpoint found for "%s".', $endpointName)
        );

        /** @var \Ivoz\Provider\Domain\Model\Friend\FriendInterface $friend */
        $friend = $endpoint->getFriend();

        Assertion::notNull(
            $friend,
            sprintf('Endpoint "%s" has no friend associated.', $endpointName)
        );

        return $friend;
    }

    /**
     * @param string $endpointName
     * @return \Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface
     * @throws \InvalidArgumentException
     */
    public function getResidentialFromEndpoint($endpointName)
    {
        $endpoint = $this->getEndpointFromName($endpointName);

        Assertion::notNull(
            $endpoint,
            sprintf('No endpoint found for "%s".', $endpointName)
        );

        /** @var \Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface $residential */
        $residential = $endpoint->getResidentialDevice();

        Assertion::notNull(
            $residential,
            sprintf('Endpoint "%s" has no residential associated.', $endpointName)
        );

        return $residential;
    }

    /**
     * @param string $endpointName
     * @return \Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface
     * @throws \InvalidArgumentException
     */
    public function getRetailFromEndpoint($endpointName)
    {
        $endpoint = $this->getEndpointFromName($endpointName);

        Assertion::notNull(
            $endpoint,
            sprintf('No endpoint found for "%s".', $endpointName)
        );

        /** @var \Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface $retailAccount */
        $retailAccount = $endpoint->getRetailAccount();

        Assertion::notNull(
            $retailAccount,
            sprintf('Endpoint "%s" has no retail account associated.', $endpointName)
        );

        return $retailAccount;
    }
}
