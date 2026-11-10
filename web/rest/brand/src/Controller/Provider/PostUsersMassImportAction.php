<?php

namespace Controller\Provider;

use ApiPlatform\Core\Exception\ResourceClassNotFoundException;
use Ivoz\Provider\Application\Service\User\SyncFromCsv;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyRepository;
use Model\UsersMassImport;
use Model\UsersMassImportError;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class PostUsersMassImportAction
{
    public function __construct(
        private TokenStorageInterface $tokenStorage,
        private CompanyRepository $companyRepository,
        private SyncFromCsv $syncFromCsv
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

        $companyId = (int) $request->request->get('company');
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
                'Users can only be imported into vPBX companies',
                Response::HTTP_BAD_REQUEST
            );
        }

        $csvFile = $request->files->get('csv');
        if (!$csvFile instanceof UploadedFile) {
            throw new \DomainException(
                'CSV file is required',
                Response::HTTP_BAD_REQUEST
            );
        }

        $uploadFailed = $csvFile->getError() !== UPLOAD_ERR_OK;
        if ($uploadFailed) {
            throw new \DomainException(
                $csvFile->getErrorMessage(),
                Response::HTTP_BAD_REQUEST
            );
        }

        $csv = (string) file_get_contents(
            $csvFile->getPathname()
        );

        $result = $this->syncFromCsv->execute(
            $company,
            $csv
        );

        $errors = array_map(
            fn (array $error): UsersMassImportError => new UsersMassImportError(
                $error['line'],
                $error['message']
            ),
            $result->getErrors()
        );

        $response = new UsersMassImport(
            $result->getCreatedCount(),
            $result->getUpdatedCount(),
            $errors
        );

        $jsonResponse = new JsonResponse(
            $response->toArray(),
            Response::HTTP_CREATED
        );
        $jsonResponse->headers->set('Content-Type', 'application/json; charset=utf-8');

        return $jsonResponse;
    }
}
