<?php

namespace spec\Ivoz\Core\Domain\Model\Helper;

use Ivoz\Core\Domain\Model\Helper\DateTimeHelper;
use PhpSpec\ObjectBehavior;
use PhpSpec\Exception\Example\FailureException;

class DateTimeHelperSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(DateTimeHelper::class);
    }

    function it_returns_null_with_empty_arguments()
    {
        $this
            ->createOrFix()
            ->shouldReturn(null);
    }

    function it_replaces_empty_value_with_default_value()
    {
        $aDateTime = new \DateTime('2010-10-10 10:10:10');
        $this
            ->createOrFix(
                null,
                $aDateTime
            )
            ->shouldReturn($aDateTime);
    }

    function it_returns_current_datetime_for_current_timestamp_default_value()
    {
        $currentDateTime = new \DateTime(
            null,
            new \DateTimeZone('UTC')
        );
        $currentTimestamp = $currentDateTime->getTimestamp();

        $responseWrapper = $this->callOnWrappedObject(
            'createOrFix',
            [null, 'current_timestamp']
        );
        $response = $responseWrapper->getWrappedObject();

        $responseTimestamp = $response->getTimestamp();
        $responseDiff = abs($currentTimestamp - $responseTimestamp);

        /**
         * Let's accept up to a couple of second offset
         */
        if ($responseDiff > 2) {
            throw new FailureException('Unexcepted value ' . $response->fornat('Y-m-d H:i:s'));
        }
    }

    function it_creates_dates_from_string()
    {
        $aDateTime = new \DateTime(
            '2011-12-13 00:00:00',
            new  \DateTimeZone('UTC')
        );
        $format = 'Y-m-d';
        $responseWrapper = $this->callOnWrappedObject(
            'createOrFix',
            [$aDateTime->format($format)]
        );
        $response = $responseWrapper->getWrappedObject();

        if ($response->format($format) !== $aDateTime->format($format)) {
            throw new FailureException('Unexpected date ' . $response->format($format));
        }
    }

    function it_creates_times_from_string()
    {
        $aDateTime = new \DateTime(
            '2011-12-13 15:58:59',
            new  \DateTimeZone('UTC')
        );
        $format = 'H:i:s';
        $responseWrapper = $this->callOnWrappedObject(
            'createOrFix',
            [$aDateTime->format($format)]
        );
        $response = $responseWrapper->getWrappedObject();

        if ($response->format($format) !== $aDateTime->format($format)) {
            throw new FailureException('Unexpected time ' . $response->format($format));
        }
    }

    function it_creates_datetimes_from_string()
    {
        $aDateTime = new \DateTime(
            '2011-12-13 15:58:59',
            new  \DateTimeZone('UTC')
        );
        $format = 'Y-m-d H:i:s';
        $responseWrapper = $this->callOnWrappedObject(
            'createOrFix',
            [$aDateTime->format($format)]
        );
        $response = $responseWrapper->getWrappedObject();

        if ($response->format($format) !== $aDateTime->format($format)) {
            throw new FailureException('Unexpected time ' . $response->format($format));
        }
    }

    function it_throws_an_exception_on_unknown_format()
    {
        $this
            ->shouldThrow('\Exception')
            ->during('createOrFix', [new \stdClass()]);
    }
}
