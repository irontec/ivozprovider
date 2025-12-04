<?php

namespace Controller\Provider\Ddi;

use ApiPlatform\Core\Exception\ResourceClassNotFoundException;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;
use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;
use Ivoz\Provider\Domain\Model\Ddi\DdiRepository;
use Ivoz\Provider\Domain\Service\Ddi\UnlinkDdi as UnlinkDdiService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class UnlinkDdisAction
{
    public function __construct(
        private TokenStorageInterface $tokenStorage,
        private DdiRepository $ddiRepository,
        private UnlinkDdiService $unlinkDdiService
    ) {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $token = $this->tokenStorage->getToken();

        if (!$token || !$token->getUser()) {
            throw new ResourceClassNotFoundException('User not found');
        }

        /** @var AdministratorInterface $user */
        $user = $token->getUser();
        $brand = $user->getBrand();
        if (!$brand) {
            throw new ResourceClassNotFoundException('User brand not found');
        }

        /** @var int[] $ddiIds */
        $ddiIds = $request->toArray();

        $brandId = $brand->getId();

        foreach ($ddiIds as $ddiId) {
            /** @var DdiInterface|null $ddi */
            $ddi = $this->ddiRepository->find($ddiId);

            if (!$ddi) {
                throw new \DomainException("DDI with id {$ddiId} not found");
            }

            if ($ddi->getBrand()->getId() !== $brandId) {
                throw new \DomainException('DDI does not belong to user brand');
            }

            $this->unlinkDdiService->execute($ddi);
        }

        return new JsonResponse(['status' => 'OK'], 200);
    }
}
