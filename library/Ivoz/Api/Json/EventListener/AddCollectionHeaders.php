<?php

namespace Ivoz\Api\Json\EventListener;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Paginator;
use ApiPlatform\Core\DataProvider\PaginatorInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

final class AddCollectionHeaders
{
    private $orderParameterName;
    private $pageParameterName;
    private $paginationEnabledParameterName;

    public function __construct(
        string $orderParameterName,
        string $pageParameterName = 'page',
        string $enabledParameterName = 'pagination'
    ) {
        $this->orderParameterName = $orderParameterName;
        $this->pageParameterName = $pageParameterName;
        $this->paginationEnabledParameterName = $enabledParameterName;
    }

    public function onKernelResponse(FilterResponseEvent $event)
    {
        $request = $event->getRequest();
        $accept = $request->headers->get('accept');
        if ($accept !== 'application/json') {
            return;
        }

        $data = $request->attributes->get('data');
        if (!$data instanceof PaginatorInterface) {
            return;
        }

        $totalItems = $data->getTotalItems();
        $lastPage = $data->getLastPage();

        $headers = [
            'X-Total-Items' => $totalItems,
            'X-Total-Pages' => $lastPage,
        ];

        $queryArguments = [];
        if ($request->request->get($this->orderParameterName)) {
            $queryArguments[$this->orderParameterName] = $request->request->get(
                $this->orderParameterName
            );
        }

        $paginationEnabled = $request->request->get(
            $this->paginationEnabledParameterName,
            true
        );

        if ($paginationEnabled) {
            $baseUrl =
                $request->getBaseUrl()
                . $request->getPathInfo();

            $currentPage = $data->getCurrentPage();
            $firstPageQueryArgument = array_merge(
                [$this->pageParameterName => 1],
                $queryArguments
            );
            $lastPageQueryArgument = array_merge(
                [$this->pageParameterName => $lastPage],
                $queryArguments
            );
            $nextPageQueryArgument = array_merge(
                [$this->pageParameterName => min($currentPage+1, $lastPage)],
                $queryArguments
            );

            $headers['X-First-Page'] = $this->buildQuery(
                $baseUrl,
                $firstPageQueryArgument
            );
            $headers['X-Next-Page'] = $this->buildQuery(
                $baseUrl,
                $nextPageQueryArgument
            );
            $headers['X-Last-Page'] = $this->buildQuery(
                $baseUrl,
                $lastPageQueryArgument
            );
        }

        $response = $event->getResponse();
        $response->headers->add($headers);
    }

    private function buildQuery(
        string $baseUrl,
        $queryArguments = []
    ) {
        if (empty($queryArguments)) {
            return $baseUrl;
        }

        $query = http_build_query(
            $queryArguments,
            '',
            '&',
            PHP_QUERY_RFC3986
        );

        $query = preg_replace('/%5B\d+%5D/', '%5B%5D', $query);

        return $baseUrl . '?' . $query;
    }
}
