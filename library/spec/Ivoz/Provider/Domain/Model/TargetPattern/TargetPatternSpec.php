<?php

namespace spec\Ivoz\Provider\Domain\Model\TargetPattern;

use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\TargetPattern\TargetPattern;
use Ivoz\Provider\Domain\Model\TargetPattern\TargetPatternDto;
use Ivoz\Provider\Infrastructure\Persistence\Doctrine\TargetPatternDoctrineRepository;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Ivoz\Provider\Domain\Model\TargetPattern\Name;
use Ivoz\Provider\Domain\Model\TargetPattern\Description;
use spec\HelperTrait;

class TargetPatternSpec extends ObjectBehavior
{
    use HelperTrait;

    function let(
        BrandInterface $brand
    ) {

        $dto = new TargetPatternDto();
        $dto->setRegExp('0-9')
            ->setNameEn('en')
            ->setNameEs('es')
            ->setDescriptionEn('en')
            ->setDescriptionEs('es');

        $this->hydrate(
            $dto,
            [
                'brand' => $brand->getWrappedObject()
            ]
        );

        $this->beConstructedThrough(
            'fromDto',
            [$dto]
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(TargetPattern::class);
    }
}
