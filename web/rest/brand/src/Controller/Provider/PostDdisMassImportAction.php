<?php

namespace Controller\Provider;

use ApiPlatform\Core\Exception\ResourceClassNotFoundException;
use Ivoz\Provider\Application\Service\Ddi\SyncFromCsv;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyRepository;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;
use Ivoz\Provider\Domain\Model\Country\CountryRepository;
use Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderInterface;
use Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderRepository;
use Ivoz\Provider\Domain\Service\Ddi\AssertCompanyAllowsDdiImport;
use Ivoz\Provider\Domain\Service\Ddi\AssertDdiProviderBelongsToAdmin;
use Model\DdisMassImport;
use Model\DdisMassImportRow;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class PostDdisMassImportAction
{
    public function __construct(
        private TokenStorageInterface $tokenStorage,
        private CompanyRepository $companyRepository,
        private CountryRepository $countryRepository,
        private DdiProviderRepository $ddiProviderRepository,
        private AssertCompanyAllowsDdiImport $assertCompanyAllowsDdiImport,
        private AssertDdiProviderBelongsToAdmin $assertDdiProviderBelongsToAdmin,
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

        $countryId = (int) $request->request->get('country');
        if ($countryId <= 0) {
            throw new \DomainException(
                'Country is required',
                Response::HTTP_BAD_REQUEST
            );
        }
        $country = $this->findCountry($countryId);

        $companyId = (int) $request->request->get('company');
        $company = $companyId > 0
            ? $this->findCompany($user, $companyId)
            : null;

        $ddiProviderId = (int) $request->request->get('ddiProvider');
        $ddiProvider = $ddiProviderId > 0
            ? $this->findDdiProvider($user, $ddiProviderId)
            : null;

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
            $brand,
            $country,
            $company,
            $ddiProvider,
            $csv
        );

        $response = new DdisMassImport(
            $result->getCreatedCount(),
            $result->getUpdatedLines(),
            $this->toRows($result->getSkippedRows()),
            $this->toRows($result->getErrors())
        );

        $jsonResponse = new JsonResponse(
            $response->toArray(),
            Response::HTTP_CREATED
        );
        $jsonResponse->headers->set('Content-Type', 'application/json; charset=utf-8');

        return $jsonResponse;
    }

    /**
     * @param list<array{line: int, message: string}> $rows
     * @return DdisMassImportRow[]
     */
    private function toRows(array $rows): array
    {
        return array_map(
            fn (array $row): DdisMassImportRow => new DdisMassImportRow(
                $row['line'],
                $row['message']
            ),
            $rows
        );
    }

    private function findCountry(int $countryId): CountryInterface
    {
        /** @var CountryInterface|null $country */
        $country = $this->countryRepository->find($countryId);
        if (!$country) {
            throw new NotFoundHttpException('Country not found');
        }

        return $country;
    }

    private function findCompany(AdministratorInterface $user, int $companyId): CompanyInterface
    {
        $company = $this->companyRepository->find($companyId);
        if (!$company) {
            throw new NotFoundHttpException('Company not found');
        }

        $this->assertCompanyAllowsDdiImport->execute($user, $company);

        return $company;
    }

    private function findDdiProvider(AdministratorInterface $user, int $ddiProviderId): DdiProviderInterface
    {
        /** @var DdiProviderInterface|null $ddiProvider */
        $ddiProvider = $this->ddiProviderRepository->find($ddiProviderId);
        if (!$ddiProvider) {
            throw new NotFoundHttpException('DDI provider not found');
        }

        $this->assertDdiProviderBelongsToAdmin->execute($user, $ddiProvider);

        return $ddiProvider;
    }
}
