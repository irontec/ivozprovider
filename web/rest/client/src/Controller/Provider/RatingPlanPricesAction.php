<?php

namespace Controller\Provider;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGenerator;
use ApiPlatform\Core\Exception\ResourceClassNotFoundException;
use Doctrine\ORM\QueryBuilder;
use Ivoz\Api\Doctrine\Orm\Extension\CollectionExtensionList;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;
use Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroup;
use Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroupRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class RatingPlanPricesAction
{
    public function __construct(
        private TokenStorageInterface $tokenStorage,
        private RatingPlanGroupRepository $ratingPlanGroupRepository,
        private CollectionExtensionList $collectionExtensions,
        private RequestStack $requestStack
    ) {
    }

    public function __invoke()
    {
        /** @var Request $request */
        $request = $this->requestStack->getCurrentRequest();

        $token =  $this->tokenStorage->getToken();

        if (!$token || !$token->getUser()) {
            throw new ResourceClassNotFoundException('User not found');
        }

        $collectionExtensions = $this->collectionExtensions;
        $queryModifier = function (QueryBuilder $qb) use ($collectionExtensions, $request) {

            $queryArguments = $request->query->all();
            unset($queryArguments['id']);
            unset($queryArguments['_timezone']);

            foreach ($queryArguments as $name => $value) {

                /** @see https://stackoverflow.com/questions/45060606/doctrine-substring-field-with-alias-in-where-clause **/
                $qb
                    ->andHaving("$name = :$name")
                    ->setParameter($name, $value);
            }

            $queryNameGenerator = new QueryNameGenerator();
            foreach ($collectionExtensions->get() as $extension) {
                $entityClass = RatingPlanGroup::class;
                $operationName = 'get_my_rating_plan_prices';

                $extension->applyToCollection(
                    $qb,
                    $queryNameGenerator,
                    $entityClass,
                    $operationName
                );
            }
        };

        $page = $request->query->has('_page');
        if ($page) {
            throw new \DomainException('_page querystring arguments is not supported here');
        }

        $itemsPerPage = $request->query->has('_itemsPerPage');
        if ($itemsPerPage) {
            throw new \DomainException('_itemsPerPage querystring arguments is not supported here');
        }

        /** @var AdministratorInterface $admin */
        $admin = $token->getUser();

        /** @var RatingPlanGroup | null $ratingPlanGroup */
        $ratingPlanGroup = $this->ratingPlanGroupRepository->find(
            $request->attributes->get('id')
        );

        if (!$ratingPlanGroup) {
            return new Response(
                Response::$statusTexts[Response::HTTP_NOT_FOUND],
                Response::HTTP_NOT_FOUND
            );
        }

        if ($ratingPlanGroup->getBrand() !== $admin->getCompany()->getBrand()) {
            return new Response(
                Response::$statusTexts[Response::HTTP_FORBIDDEN],
                Response::HTTP_FORBIDDEN
            );
        }

        $generator = $this
            ->ratingPlanGroupRepository
            ->getAllRatesByRatingPlanId(
                (int) $ratingPlanGroup->getId(),
                10000,
                $queryModifier
            );

        set_time_limit(0);
        $tmpfile = tmpfile();
        fwrite(
            $tmpfile,
            '"rating plan", name, prefix, "connection fee", cost'
            . ', "rate increment", "group interval start", "time in", days'
            . "\n"
        );
        foreach ($generator as $batch) {
            foreach ($batch as $item) {
                fwrite(
                    $tmpfile,
                    $this->array2csv($item) . "\n"
                );
            }
        }

        $response = new StreamedResponse(function () use ($tmpfile) {
            fseek($tmpfile, 0);
            \stream_copy_to_stream($tmpfile, \fopen('php://output', 'wb'));
        });

        $disposition = $response->headers->makeDisposition(
            ResponseHeaderBag::DISPOSITION_INLINE,
            'prices.csv'
        );

        $response->headers->set(
            'Content-Disposition',
            $disposition
        );
        $response->headers->set(
            'Content-Type',
            'text/csv'
        );

        return $response;
    }

    /**
     * @param array<array-key, \Stringable|null|scalar> $fields
     * @return string
     */
    private function array2csv(array $fields): string
    {
        unset($fields['weight']);

        $f = fopen('php://memory', 'r+');
        if (fputcsv($f, $fields) === false) {
            return '';
        }
        rewind($f);
        $csv_line = stream_get_contents($f);
        return rtrim($csv_line);
    }
}
