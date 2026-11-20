<?php

namespace Controller\Provider;

use ApiPlatform\Core\Exception\ResourceClassNotFoundException;
use Ivoz\Provider\Application\Service\User\ExportToCsv;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyRepository;
use Symfony\Component\HttpFoundation\HeaderUtils;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class GetUsersMassExportAction
{
    public function __construct(
        private TokenStorageInterface $tokenStorage,
        private CompanyRepository $companyRepository,
        private ExportToCsv $exportToCsv
    ) {
    }

    public function __invoke(Request $request): Response
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

        $companyId = (int) $request->query->get('company');
        if ($companyId <= 0) {
            throw new \DomainException(
                'Company is required',
                Response::HTTP_BAD_REQUEST
            );
        }

        $company = $this->companyRepository->find($companyId);
        if (!$company) {
            throw new NotFoundHttpException('Company not found');
        }

        if ($company->getBrand() !== $brand) {
            throw new \DomainException(
                'Forbidden company',
                Response::HTTP_FORBIDDEN
            );
        }

        if (!$company->isVpbx()) {
            throw new \DomainException(
                'Users can only be exported from vPBX companies',
                Response::HTTP_BAD_REQUEST
            );
        }

        try {
            $csv = $this->exportToCsv->execute($company);
        } catch (\DomainException $e) {
            throw new \DomainException(
                $e->getMessage(),
                Response::HTTP_BAD_REQUEST,
                $e
            );
        }

        $response = new StreamedResponse(function () use ($csv): void {
            echo $csv;
        });
        $response->headers->set('Content-Type', 'text/csv; charset=utf-8');
        $response->headers->set(
            'Content-Disposition',
            HeaderUtils::makeDisposition(
                HeaderUtils::DISPOSITION_ATTACHMENT,
                $company->getName() . '-users.csv',
                'users.csv'
            )
        );

        return $response;
    }
}
