<?php

namespace Controller\My;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\QueryResultCollectionExtensionInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Paginator;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGenerator;
use ApiPlatform\Core\Util\RequestParser;
use Doctrine\ORM\QueryBuilder;
use Ivoz\Api\Doctrine\Orm\Extension\CollectionExtensionList;
use Ivoz\Core\Domain\Model\EntityInterface;

trait FilterCollectionTrait
{
    /**
     * @var \Symfony\Component\HttpFoundation\Request|null
     */
    private $request;
    private CollectionExtensionList $collectionExtensions;

    /**
     * @return array<int, EntityInterface> | iterable | Paginator
     * @phpstan-ignore-next-line
     */
    protected function applyCollectionExtensions(QueryBuilder $qb, string $entityClass, string $operationName)
    {
        if (!$this->request) {
            throw new \RuntimeException('Request instance not found');
        }

        $context = [];
        $queryString = RequestParser::getQueryString($this->request);
        $context['filters'] = $queryString ? RequestParser::parseRequestParams($queryString) : null;

        $queryNameGenerator = new QueryNameGenerator();
        foreach ($this->collectionExtensions->get() as $extension) {
            /** @phpstan-ignore-next-line  */
            $extension->applyToCollection(
                $qb,
                $queryNameGenerator,
                $entityClass,
                $operationName,
                $context
            );

            $returnResults =
                $extension instanceof QueryResultCollectionExtensionInterface
                && $extension->supportsResult($entityClass, $operationName);

            if ($returnResults) {
                /** @var QueryResultCollectionExtensionInterface $extension */
                return $extension->getResult($qb);
            }
        }

        return $qb->getQuery()->getResult();
    }
}
