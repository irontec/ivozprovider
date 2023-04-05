<?php

namespace Controller\Provider\SimulateCall;

use Ivoz\Provider\Application\Service\RatingPlanGroup\SimulateCallByRatingPlanGroup;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class SimulateCallRatingPlanGroupAction
{
    public function __construct(
        private TokenStorageInterface $tokenStorage,
        private SimulateCallByRatingPlanGroup $simulateCallByRatingPlanGroup
    ) {
    }

    public function __invoke(Request $request): Response
    {
        $ratingPlanGroupId = (int) $request->attributes->get('id');
        $phone = (string) $request->request->get('number');
        $duration = (int) $request->request->get('duration');
        $token =  $this->tokenStorage->getToken();

        if (!$token) {
            throw new \DomainException('Token not found', 403);
        }

        /** @var ?AdministratorInterface $loggedUser */
        $loggedUser = $token->getUser();

        if (!$loggedUser instanceof AdministratorInterface) {
            throw new \DomainException("Administrator not found", 403);
        }

        $brand = $loggedUser->getBrand();

        if (!$brand) {
            throw new \DomainException('Admin must belong to a specific brand', 403);
        }

        $tarificationInfo = $this
            ->simulateCallByRatingPlanGroup
            ->execute(
                $brand,
                $duration,
                $phone,
                $ratingPlanGroupId
            );

        $headers = [
            'content-type' => 'application/json; charset=UTF-8'
        ];

        $response = json_encode(
            $tarificationInfo->toArray()
        );

        if (!$response) {
            throw new \DomainException('Unexpected object response');
        }

        return new Response(
            $response,
            200,
            $headers
        );
    }
}
