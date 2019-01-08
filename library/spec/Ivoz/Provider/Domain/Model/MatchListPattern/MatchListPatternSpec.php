<?php

namespace spec\Ivoz\Provider\Domain\Model\MatchListPattern;

use Ivoz\Provider\Domain\Model\MatchListPattern\MatchListPattern;
use Ivoz\Provider\Domain\Model\MatchListPattern\MatchListPatternDto;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;

class MatchListPatternSpec extends ObjectBehavior
{
    use HelperTrait;

    /**
     * @var ExtensionDto
     */
    protected $dto;

    function let()
    {
        $this->dto = $dto = new MatchListPatternDto();
        $dto
            ->setType('number');

        $this->beConstructedThrough(
            'fromDto',
            [$dto, new \spec\DtoToEntityFakeTransformer()]
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(MatchListPattern::class);
    }

    function it_resets_regexp_when_type_is_number()
    {
        $this
            ->dto
            ->setType('number')
            ->setNumbervalue((string) 1)
            ->setRegExp('0-9');

        $this
            ->getRegExp()
            ->shouldBe(null);

        $this
            ->getNumbervalue()
            ->shouldBe('1');
    }

    function it_resets_number_when_type_is_regexp()
    {
        $this
            ->dto
            ->setType('regexp')
            ->setNumbervalue((string) 1)
            ->setRegExp('0-9');

        $this
            ->getNumbervalue()
            ->shouldBe(null);

        $this
            ->getRegExp()
            ->shouldBe('0-9');
    }
}
