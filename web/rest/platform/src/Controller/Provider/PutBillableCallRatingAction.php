<?php

namespace Controller\Provider;

use ApiPlatform\Core\Exception\ResourceClassNotFoundException;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCall;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCallDto;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCallRepository;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class PutBillableCallRatingAction
{
    public function __construct(
        private TokenStorageInterface $tokenStorage,
        private DenormalizerInterface $denormalizer,
        private RequestStack $requestStack,
        private BillableCallRepository $billableCallRepository
    ) {
    }

    public function __invoke()
    {
        $token = $this->tokenStorage->getToken();

        if (!$token || !$token->getUser()) {
            throw new ResourceClassNotFoundException('User not found');
        }

        $request = $this->requestStack->getCurrentRequest();
        $content = $request->getContent();
        $format = $request->getRequestFormat();

        /** @phpstan-ignore-next-line */
        $data = $this->denormalizer->decode(
            $content,
            $format,
            []
        );

        if (isset($data['destinationName'])) {
            $data['destination'] = null;
        }

        if (isset($data['ratingPlanName'])) {
            $data['ratingPlanGroup'] = null;
        }

        $callid = $request->attributes->get('callid');
        $calls = $this->billableCallRepository->findOutboundByCallid(
            $callid
        );

        if (empty($calls)) {
            throw new NotFoundHttpException();
        }

        if (count($calls) !== 1) {
            $errorMsg = sprintf(
                'Multiple calls found with callid %s',
                $callid
            );

            throw new \DomainException($errorMsg, 500);
        }

        $billableCall = $calls[0];

        return $this->denormalizer->denormalize(
            $data,
            BillableCall::class,
            $request->getRequestFormat(),
            [
                'object_to_populate' => $billableCall,
                'operation_normalization_context' => BillableCallDto::CONTEXT_RATING_INTERNAL
            ]
        );
    }
}
