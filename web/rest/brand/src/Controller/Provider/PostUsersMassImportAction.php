<?php

namespace Controller\Provider;

use ApiPlatform\Core\Exception\ResourceClassNotFoundException;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Provider\Application\Service\User\SyncFromCsv;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyRepository;
use Model\UsersMassImport;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class PostUsersMassImportAction
{
    public function __construct(
        private TokenStorageInterface $tokenStorage,
        private DenormalizerInterface $denormalizer,
        private CompanyRepository $companyRepository,
        private SyncFromCsv $syncFromCsv
    ) {
    }

    public function __invoke(Request $request)
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

        $companyId = $request->request->get('company');
        $company = $this->companyRepository->find($companyId);
        if (!$company) {
            throw new ResourceClassNotFoundException('Company not found');
        }

        if ($company->getBrand() !== $brand) {
            throw new \DomainException(
                'Forbidden company',
                403
            );
        }

        /** @var UploadedFile|null $csvFile */
        $csvFile = $request->files->get('csv');
        if (!$csvFile) {
            throw new ResourceClassNotFoundException('CSV file not found');
        }
        $csv = file_get_contents($csvFile->getPathname());

        $errorMsg = '';
        $rowsFailed = 0;
        try {
            $this->syncFromCsv->execute(
                $company,
                $csv
            );
        } catch (\Exception $e) {
            $errorMsg = $e->getMessage();
            $rowsFailed = $e->getCode();
        }

        $success = $rowsFailed === 0;
        $response = new UsersMassImport(
            $success,
            $errorMsg,
            $rowsFailed
        );

        return $this->denormalizer->denormalize(
            [],
            UsersMassImport::class,
            $request->getRequestFormat(),
            [
                'object_to_populate' => $response,
                'operation_normalization_context' => DataTransferObjectInterface::CONTEXT_SIMPLE
            ]
        );
    }
}
