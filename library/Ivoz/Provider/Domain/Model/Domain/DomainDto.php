<?php

namespace Ivoz\Provider\Domain\Model\Domain;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;


class DomainDto extends DomainDtoAbstract
{
    /**
     * @return array
     */
    public function normalize(string $context)
    {
        $values = parent::normalize($context);
        $allowedValues = [
            'domain',
            'id',
        ];

        switch ($context) {
            case 'item':
                array_push($allowedValues, ...[
                    'friends',
                    'retailAccounts',
                    'terminals'
                ]);
            case 'list':
                array_push($allowedValues, ...[
                    'pointsTo',
                    'description',
                ]);
        }
        $filtered = array_filter(
            $values,
            function ($key) use ($allowedValues) {
                return in_array($key, $allowedValues);
            },
            ARRAY_FILTER_USE_KEY
        );

        return $filtered;
    }
}


