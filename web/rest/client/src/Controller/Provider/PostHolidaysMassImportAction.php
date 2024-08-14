<?php

namespace Controller\Provider;

use ApiPlatform\Core\Exception\ResourceClassNotFoundException;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Provider\Application\Service\HolidayDate\SyncFromCsv;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;
use Ivoz\Provider\Domain\Model\Calendar\CalendarRepository;
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
        private CalendarRepository $calendarRepository,
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
        $companyId = $company->getId() ?? -1;

        $calendar = $this->calendarRepository->findCompanyCalendar($companyId, (int)$calendarId);
        if (is_null($calendar)) {
            throw new NotFoundHttpException('Calendar not found');
        }

        $importerArguments = $request->request->get('importerArguments');
        $csv = file_get_contents(
            (string) $request->files->get('csv')
        );

        $this->syncFromCsv->execute(
            (string) $calendarId,
            (string) $csv,
            (string) $importerArguments
        );

        $errors = $this->syncFromCsv->getErrors();
        $jsonErrors = json_encode($errors);
        $rowsFailed = count($errors);
        $success = $rowsFailed === 0;

        $errorMsg = $jsonErrors === false
            ? ''
            : $jsonErrors;

        $response = new HolidaysMassImport(
            $success,
            $errorMsg,
            $rowsFailed
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
