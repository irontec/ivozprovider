<?php

namespace Controller\My;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\QueryResultCollectionExtensionInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGenerator;
use ApiPlatform\Core\Exception\ResourceClassNotFoundException;
use Doctrine\ORM\QueryBuilder;
use Ivoz\Api\Doctrine\Orm\Extension\CollectionExtensionList;
use Ivoz\Kam\Domain\Model\UsersCdr\UsersCdrRepository;
use Ivoz\Kam\Domain\Model\UsersCdr\UsersCdr;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class CallHistoryAction
{
    /**
     * @var TokenStorage
     */
    protected $tokenStorage;

    /**
     * @var UsersCdrRepository
     */
    protected $usersCdrRepository;

    /**
     * @var CollectionExtensionList
     */
    protected $collectionExtensions;

    public function __construct (
        TokenStorage $tokenStorage,
        UsersCdrRepository $usersCdrRepository,
        CollectionExtensionList $collectionExtensions
    ) {
        $this->tokenStorage = $tokenStorage;
        $this->usersCdrRepository = $usersCdrRepository;
        $this->collectionExtensions = $collectionExtensions;
    }

    public function __invoke()
    {
        /** @var TokenInterface $token */
        $token =  $this->tokenStorage->getToken();

        if (!$token || !$token->getUser()) {
            throw new ResourceClassNotFoundException('User not found');
        }

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

        return $this->applyCollectionExtensions(
            $qb,
            UsersCdr::class,
            'my_call_history'
        );
    }

    protected function applyCollectionExtensions(QueryBuilder $qb, string $entityClass, string $operationName)
    {
        $queryNameGenerator = new QueryNameGenerator();
        foreach ($this->collectionExtensions->get() as $extension) {
            $extension->applyToCollection(
                $qb,
                $queryNameGenerator,
                $entityClass,
                $operationName
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