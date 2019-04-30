<?php

namespace spec\Ivoz\Core\Infrastructure\Persistence\Doctrine\Model\Helper;

use Ivoz\Core\Infrastructure\Persistence\Doctrine\Model\Helper\CriteriaHelper;
use PhpSpec\Exception\Example\FailureException;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CriteriaHelperSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(CriteriaHelper::class);
    }

    function it_should_handle_or_conditions()
    {
        $seed = [
            'or' => [
                ['callForwardType', 'eq', 'noAnswer'],
                ['callForwardType', 'eq', 'busy'],
            ],
            ['enabled', 'eq', '1']
        ];

        $criteria = CriteriaHelper::fromArray($seed);
        $arrayCriteria = CriteriaHelper::toArray($criteria);

        if ($arrayCriteria !== $seed) {
            throw new FailureException('Some criteria data have been lost');
        }
    }

    function it_should_handle_multiple_or_conditions()
    {
        $seed = [
            'or' => [
                ['callForwardType', 'eq', 'noAnswer'],
                ['callForwardType', 'eq', 'busy'],
            ],
            ['or' => [
                ['callTypeFilter', 'eq', 'both'],
                ['callTypeFilter', 'eq', 'something'],
            ]],
            ['enabled', 'eq', 1]
        ];
        $criteria = CriteriaHelper::fromArray($seed);
        $array = CriteriaHelper::toArray($criteria);
        if ($array !== $seed) {
            throw new FailureException('Some criteria data have been lost');
        }
    }

    function it_should_nest_conditions()
    {
        $seed1 = [
            'or' => [
                ['callForwardType', 'eq', 'noAnswer'],
                ['callForwardType', 'eq', 'busy'],
                ['callForwardType', 'eq', 'userNotRegistered'],
            ],
            ['enabled', 'eq', 1]
        ];
        $criteria1 = CriteriaHelper::fromArray($seed1);
        $array1 = CriteriaHelper::toArray($criteria1);
        if ($array1 !== $seed1) {
            throw new FailureException('Some criteria data have been lost');
        }

        $seed2 = [
            'or' => [
                ['callTypeFilter', 'eq', 'both'],
                ['callTypeFilter', 'eq', 'something'],
            ]
        ];
        $criteria2 = CriteriaHelper::fromArray($seed2);
        $array2 = CriteriaHelper::toArray($criteria2);
        if ($array2 !== $seed2) {
            throw new FailureException('Some criteria data have been lost');
        }

        $nestedCriteria = CriteriaHelper::append('and', $criteria1, $criteria2);
        $nestedArrayCriteria = CriteriaHelper::toArray($nestedCriteria);

        $expectedArrayCriteria = array_merge(
            ['and' => $seed1],
            $seed2
        );
        if ($nestedArrayCriteria !== $expectedArrayCriteria) {
            throw new FailureException('Some criteria data have been lost');
        }
    }
}
