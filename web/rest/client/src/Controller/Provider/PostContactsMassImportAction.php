<?php

namespace Controller\Provider;

use ApiPlatform\Core\Exception\ResourceClassNotFoundException;
use Ivoz\Provider\Application\Service\Contact\SyncFromCsv;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;
use Model\ContactsMassImport;
use Model\ContactsMassImportError;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class PostContactsMassImportAction
{
    public function __construct(
        private TokenStorageInterface $tokenStorage,
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

        $company = $user->getCompany();
        if (!$company) {
            throw new NotFoundHttpException('Company not found');
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
            fn (array $error): ContactsMassImportError => new ContactsMassImportError(
                $error['line'],
                $error['message']
            ),
            $result->getErrors()
        );

        $response = new ContactsMassImport(
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
