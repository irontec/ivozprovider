<?php

namespace Helpers;

use Assert\Assertion;
use Doctrine\ORM\EntityManagerInterface;
use Ivoz\Provider\Domain\Model\Domain\Domain;
use Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface;
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
     * @param $endpointName
     * @return \Ivoz\Provider\Domain\Model\User\UserInterface
     * @throws \Assert\AssertionFailedException
     */
    public function getUserFromEndpoint($endpointName)
    {
        /** @var \Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface $endpoint */
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
            sprintf('User "%s" has no extension associated.', $user))
        );

        return $user;
    }

    /**
     * @param $endpointName
     * @return \Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface
     */
    public function getEndpointFromName($endpointName)
    {
        /** @var \Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointRepository $endpointRepository */
        $endpointRepository = $this->em->getRepository('Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpoint');

        /** @var \Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface $endpoint */
        $endpoint = $endpointRepository->findOneBy([
            "sorceryId" => $endpointName
        ]);

        return $endpoint;
    }

    /**
     * @param $endpointNum
     * @param $endpointDomain
     * @return string
     * @throws \Assert\AssertionFailedException
     */
    public function getEndpointNameFromContact($endpointNum, $endpointDomain)
    {
        /** @var \Ivoz\Provider\Domain\Model\Domain\DomainRepository $domainRepository */
        $domainRepository = $this->em->getRepository(Domain::class);
        /** @var \Ivoz\Provider\Domain\Model\Domain\DomainInterface $domain */
        $domain = $domainRepository->findOneBy([
            'domain' => $endpointDomain
        ]);

        Assertion::notNull(
            $domain,
            sprintf('No Domain found for "%s".', $endpointDomain)
        );

        /** @var \Ivoz\Provider\Domain\Model\Terminal\TerminalRepository $terminalRepository */
        $terminalRepository = $this->em->getRepository(Terminal::class);
        /** @var \Ivoz\Provider\Domain\Model\Terminal\TerminalInterface $terminal */
        $terminal = $terminalRepository->findOneBy([
            'name' => $endpointNum,
            'domain' => $domain->getId()
        ]);

        Assertion::notNull(
            $terminal,
            sprintf('No Terminal found for "%s@%s"', $endpointNum, $endpointDomain)
        );

        /** @var \Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface $endpoint */
        $endpoint = $terminal->getAstPsEndpoint();
        Assertion::notNull(
            $endpoint,
            sprintf('No endpoint found for "%s".', $endpointNum)
        );

        // Get the endpoint name matching the referer contact
        return $endpoint->getSorceryId();
    }

    /**
     * @param $endpointName
     * @return \Ivoz\Provider\Domain\Model\Friend\FriendInterface|null
     * @throws \Assert\AssertionFailedException
     */
    public function getFriendFromEndpoint($endpointName)
    {
        /** @var \Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface $endpoint */
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
     * @param $endpointName
     * @return RetailAccountInterface|null
     * @throws \Assert\AssertionFailedException
     */
    public function getRetailFromEndpoint($endpointName)
    {
        /** @var \Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface $endpoint */
        $endpoint = $this->getEndpointFromName($endpointName);

        Assertion::notNull(
            $endpoint,
            sprintf('No endpoint found for "%s".', $endpointName)
        );

        /** @var \Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface $retail */
        $retail = $endpoint->getRetailAccount();

        Assertion::notNull(
            $retail,
            sprintf('Endpoint "%s" has no retail associated.', $endpointName)
        );

        return $retail;
    }

}