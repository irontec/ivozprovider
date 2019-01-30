<?php

namespace Controller\My;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGenerator;
use ApiPlatform\Core\Exception\ResourceClassNotFoundException;
use Doctrine\ORM\QueryBuilder;
use Ivoz\Api\Doctrine\Orm\Extension\CollectionExtensionList;
use Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroup;
use Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroupRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class RatingPlanPricesAction
{
    /**
     * @var TokenStorage
     */
    protected $tokenStorage;

    /**
     * @var RatingPlanGroupRepository
     */
    protected $ratingPlanGroupRepository;

    /**
     * @var CollectionExtensionList
     */
    protected $collectionExtensions;

    /**
     * @var RequestStack
     */
    protected $requestStack;

    public function __construct(
        TokenStorage $tokenStorage,
        RatingPlanGroupRepository $ratingPlanGroupRepository,
        CollectionExtensionList $collectionExtensions,
        RequestStack $requestStack
    ) {
        $this->tokenStorage = $tokenStorage;
        $this->ratingPlanGroupRepository = $ratingPlanGroupRepository;
        $this->collectionExtensions = $collectionExtensions;
        $this->requestStack = $requestStack;
    }

    public function __invoke()
    {
        /** @var Request $request */
        $request = $this->requestStack->getCurrentRequest();

        /** @var TokenInterface $token */
        $token =  $this->tokenStorage->getToken();

        if (!$token || !$token->getUser()) {
            throw new ResourceClassNotFoundException('User not found');
        }

        $collectionExtensions = $this->collectionExtensions;
        $queryModifier = function (QueryBuilder $qb) use ($collectionExtensions, $request) {

            $queryArguments = $request->query->all();
            unset($queryArguments['id']);

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

        $ratingPlanGroupId = $request
            ->query
            ->get('id');

        $generator = $this
            ->ratingPlanGroupRepository
            ->getAllRatesByRatingPlanId(
                $ratingPlanGroupId,
                10000,
                $queryModifier
            );

        $payload = '';

        foreach ($generator as $batch) {
            foreach ($batch as $item) {
                $payload .= $this->array2csv($item) . "\n";
            }
        }

        return new Response($payload);
    }

    private function array2csv(array $fields) : string
    {
        unset($fields['weight']);

        $f = fopen('php://memory', 'r+');
        if (fputcsv($f, $fields) === false) {
            return false;
        }
        rewind($f);
        $csv_line = stream_get_contents($f);
        return rtrim($csv_line);
    }
}
