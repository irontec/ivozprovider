<?php

namespace Controller\My;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\QueryResultCollectionExtensionInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGenerator;
use ApiPlatform\Core\Exception\ResourceClassNotFoundException;
use ApiPlatform\Core\Util\RequestParser;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Ivoz\Api\Doctrine\Orm\Extension\CollectionExtensionList;
use Ivoz\Kam\Domain\Model\UsersCdr\UsersCdrRepository;
use Ivoz\Kam\Domain\Model\UsersCdr\UsersCdr;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Paginator;

class CallHistoryAction
{
    protected $tokenStorage;

    /**
     * @var EntityRepository | UsersCdrRepository
     */
    protected $usersCdrRepository;

    protected $collectionExtensions;

    protected $request;

    public function __construct(
        TokenStorage $tokenStorage,
        UsersCdrRepository $usersCdrRepository,
        CollectionExtensionList $collectionExtensions,
        RequestStack $requestStack
    ) {
        $this->tokenStorage = $tokenStorage;
        $this->usersCdrRepository = $usersCdrRepository;
        $this->collectionExtensions = $collectionExtensions;
        $this->request = $requestStack->getCurrentRequest();
    }

    public function __invoke()
    {
        /** @var TokenInterface $token */
        $token =  $this->tokenStorage->getToken();

        if (!$token || !$token->getUser()) {
            throw new ResourceClassNotFoundException('User not found');
        }

        /** @var UserInterface $user */
        $user = $token->getUser();
        $qb = $this
            ->usersCdrRepository
            ->createQueryBuilder('o');

        $qb->where(
            $qb->expr()->eq(
                'o.user',
                $user->getId()
            )
        );

        $qb->andWhere(
            $qb->expr()->eq(
                'o.hidden',
                0
            )
        );

        $response = $this->applyCollectionExtensions(
            $qb,
            UsersCdr::class,
            'my_call_history'
        );

        $calls = $response instanceof Paginator
            ? $response->getIterator()
            : new \ArrayIterator($response);
        $this->setUserTimezone($user, $calls);

        return $response;
    }

    /**
     * @param UserInterface $user
     * @param \Traversable $calls
     * @return Paginator
     */
    protected function setUserTimezone(UserInterface $user, \Traversable $calls)
    {
        $userTimeZone = $user->getTimezone();
        $timezone = new \DateTimeZone(
            $userTimeZone->getTz()
        );

        foreach ($calls as $call) {
            $call
                ->getStartTime()
                ->setTimezone($timezone);

            $call
                ->getEndTime()
                ->setTimezone($timezone);
        }
    }

    /**
     * @param QueryBuilder $qb
     * @param string $entityClass
     * @param string $operationName
     * @return Paginator | array
     */
    protected function applyCollectionExtensions(QueryBuilder $qb, string $entityClass, string $operationName)
    {
        $context = [];
        $queryString = RequestParser::getQueryString($this->request);
        $context['filters'] = $queryString ? RequestParser::parseRequestParams($queryString) : null;

        $queryNameGenerator = new QueryNameGenerator();
        foreach ($this->collectionExtensions->get() as $extension) {
            $extension->applyToCollection(
                $qb,
                $queryNameGenerator,
                $entityClass,
                $operationName,
                $context
            );

            $returnResults =
                $extension instanceof QueryResultCollectionExtensionInterface
                && $extension->supportsResult($entityClass, $operationName);

            if ($returnResults) {
                return $extension->getResult($qb);
            }
        }

        return $qb->getQuery()->getResult();
    }
}
