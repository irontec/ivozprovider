<?php

namespace Controller\Provider;

use ApiPlatform\Core\Exception\ResourceClassNotFoundException;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Provider\Application\Service\HolidayDate\SyncFromCsv;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;
use Model\HolidaysMassImport;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class PostHolidaysMassImportAction
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

        $calendarId = $request->request->get('calendar');
        $csv = file_get_contents(
            (string) $request->files->get('csv')
        );

        $errorMsg = '';
        $rowsFailed = 0;
        try {
            $this->syncFromCsv->execute(
                (string) $calendarId,
                (string) $csv
            );
        } catch (\Exception $e) {
            $errorMsg = $e->getMessage();
            $rowsFailed = $e->getCode();
        }

        $success = $rowsFailed === 0;
        $response = new HolidaysMassImport(
            $success,
            $errorMsg,
            (int) $rowsFailed
        );

        return $this->denormalizer->denormalize(
            [],
            HolidaysMassImport::class,
            $request->getRequestFormat(),
            [
                'object_to_populate' => $response,
                'operation_normalization_context' => DataTransferObjectInterface::CONTEXT_SIMPLE
            ]
        );
    }
}
