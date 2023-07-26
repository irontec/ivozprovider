<?php

namespace Controller\Provider\BillableCall;

use ApiPlatform\Core\Exception\ResourceClassNotFoundException;
use Ivoz\Cgr\Infrastructure\Cgrates\Service\RerateCallService;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;
use Model\ACK;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\HttpFoundation\Request;

class RerateAction
{
    public function __construct(
        private TokenStorageInterface $tokenStorage,
        private DenormalizerInterface $denormalizer,
        private RerateCallService $rerateCallService
    ) {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $token = $this->tokenStorage->getToken();

        if (!$token || !$token->getUser()) {
            throw new ResourceClassNotFoundException('Admin not found');
        }

        /** @var AdministratorInterface $user */
        $user = $token->getUser();

        $brand = $user->getBrand();
        if (!$brand) {
            throw new ResourceClassNotFoundException('User brand not found');
        }

        $content = $request->getContent();
        $format = $request->getRequestFormat('json');

        /**
         * @var int[]|null $ids
         * @phpstan-ignore-next-line
         * @psalm-suppress UndefinedInterfaceMethod
         */
        $ids = $this->denormalizer->decode(
            $content,
            $format,
            []
        );

        if (!is_array($ids)) {
            throw new \DomainException(
                'Unexpected payload format',
                400
            );
        }

        $this
            ->rerateCallService
            ->execute($ids);

        return new JsonResponse(
            (new ACK())->toArray(),
            200
        );
    }
}
