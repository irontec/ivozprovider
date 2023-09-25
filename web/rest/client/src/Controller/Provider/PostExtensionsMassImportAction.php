<?php

namespace Controller\Provider;

use ApiPlatform\Core\Exception\ResourceClassNotFoundException;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Provider\Application\Service\Extension\SyncFromCsv;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;
use Model\ExtensionsMassImport;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class PostExtensionsMassImportAction
{
    public function __construct(
        private DenormalizerInterface $denormalizer,
        private TokenStorageInterface $tokenStorage,
        private SyncFromCsv $syncFromCsv
    ) {
    }

    /**
     * @return mixed
     */
    public function __invoke(Request $request)
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

        /** @var int $companyId */
        $companyId = $company->getId();

        $csv = file_get_contents(
            (string) $request->files->get('csv')
        );

        $errorMsg = '';
        $rowsFailed = 0;
        try {
            $this->syncFromCsv->execute(
                $companyId,
                (string) $csv
            );
        } catch (\Exception $e) {
            $errorMsg = $e->getMessage();
            $rowsFailed = $e->getCode();
        }

        $success = $rowsFailed === 0;
        $response = new ExtensionsMassImport(
            $success,
            $errorMsg,
            (int) $rowsFailed
        );

        return $this->denormalizer->denormalize(
            [],
            ExtensionsMassImport::class,
            $request->getRequestFormat(),
            [
                'object_to_populate' => $response,
                'operation_normalization_context' => DataTransferObjectInterface::CONTEXT_SIMPLE
            ]
        );
    }
}
