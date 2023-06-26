<?php

namespace Controller\My;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Paginator;
use ApiPlatform\Core\Exception\ResourceClassNotFoundException;
use Ivoz\Api\Doctrine\Orm\Extension\CollectionExtensionList;
use Ivoz\Kam\Domain\Model\UsersCdr\UsersCdr;
use Ivoz\Kam\Domain\Model\UsersCdr\UsersCdrRepository;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class CallHistoryAction
{
    use FilterCollectionTrait;

    public function __construct(
        private TokenStorageInterface $tokenStorage,
        private UsersCdrRepository $usersCdrRepository,
        CollectionExtensionList $collectionExtensions,
        RequestStack $requestStack
    ) {
        $this->collectionExtensions = $collectionExtensions;
        $this->request = $requestStack->getCurrentRequest();
    }

    public function __invoke()
    {
        $token =  $this->tokenStorage->getToken();

        if (!$token || !$token->getUser()) {
            throw new ResourceClassNotFoundException('User not found');
        }

        /** @var UserInterface $user */
        $user = $token->getUser();
        /** @phpstan-ignore-next-line  */
        $qb = $this
            ->usersCdrRepository
            ->createQueryBuilder('o');

        $qb->where(
            $qb->expr()->eq(
                'o.user',
                $user->getId()
            )
        );

        $response = $this->applyCollectionExtensions(
            $qb,
            UsersCdr::class,
            'my_call_history'
        );

        $calls = $response instanceof Paginator
            ? $response->getIterator()
            : new \ArrayIterator([...$response]);

        $this->setUserTimezone($user, $calls);

        return $response;
    }

    protected function setUserTimezone(UserInterface $user, \Traversable $calls): void
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
}
