<?php

namespace spec\Ivoz\Core\Domain\Model\Helper;

use Assert\Assertion;
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

    function it_subtracts_one_month()
    {
        // Initial, Inteval, ExpectedResult
        $dataSet = [
            ['2019-01-01 00:00:00', 'P1M', '2018-12-01 00:00:00'],
            ['2019-01-15 00:00:00', 'P1M', '2018-12-15 00:00:00'],
            ['2019-01-31 00:00:00', 'P1M', '2018-12-31 00:00:00'],

            ['2019-02-01 00:00:00', 'P1M', '2019-01-01 00:00:00'],
            ['2019-02-15 00:00:00', 'P1M', '2019-01-15 00:00:00'],
            ['2019-02-28 00:00:00', 'P1M', '2019-01-31 00:00:00'],
            ['2019-02-28 00:00:00', 'P2M', '2018-12-31 00:00:00'],
            ['2019-02-28 00:00:00', 'P3M', '2018-11-30 00:00:00'],

            ['2019-03-01 00:00:00', 'P1M', '2019-02-01 00:00:00'],
            ['2019-03-15 00:00:00', 'P1M', '2019-02-15 00:00:00'],
            ['2019-03-31 00:00:00', 'P1M', '2019-02-28 00:00:00'],

            ['2019-04-01 00:00:00', 'P1M', '2019-03-01 00:00:00'],
            ['2019-04-15 00:00:00', 'P1M', '2019-03-15 00:00:00'],
            ['2019-04-30 00:00:00', 'P1M', '2019-03-31 00:00:00'],
            ['2019-04-30 00:00:00', 'P2M', '2019-02-28 00:00:00'],

            ['2019-05-01 00:00:00', 'P1M', '2019-04-01 00:00:00'],
            ['2019-05-15 00:00:00', 'P1M', '2019-04-15 00:00:00'],
            ['2019-05-31 00:00:00', 'P1M', '2019-04-30 00:00:00'],
            ['2019-05-31 00:00:00', 'P3M', '2019-02-28 00:00:00'],

            ['2019-06-01 00:00:00', 'P1M', '2019-05-01 00:00:00'],
            ['2019-06-15 00:00:00', 'P1M', '2019-05-15 00:00:00'],
            ['2019-06-30 00:00:00', 'P1M', '2019-05-31 00:00:00'],

            ['2019-07-01 00:00:00', 'P1M', '2019-06-01 00:00:00'],
            ['2019-07-15 00:00:00', 'P1M', '2019-06-15 00:00:00'],
            ['2019-07-31 00:00:00', 'P1M', '2019-06-30 00:00:00'],

            ['2019-08-01 00:00:00', 'P1M', '2019-07-01 00:00:00'],
            ['2019-08-15 00:00:00', 'P1M', '2019-07-15 00:00:00'],
            ['2019-08-31 00:00:00', 'P1M', '2019-07-31 00:00:00'],

            ['2019-09-01 00:00:00', 'P1M', '2019-08-01 00:00:00'],
            ['2019-09-15 00:00:00', 'P1M', '2019-08-15 00:00:00'],
            ['2019-09-30 00:00:00', 'P1M', '2019-08-31 00:00:00'],

            ['2019-10-01 00:00:00', 'P1M', '2019-09-01 00:00:00'],
            ['2019-10-15 00:00:00', 'P1M', '2019-09-15 00:00:00'],
            ['2019-10-31 00:00:00', 'P1M', '2019-09-30 00:00:00'],

            ['2019-11-01 00:00:00', 'P1M', '2019-10-01 00:00:00'],
            ['2019-11-15 00:00:00', 'P1M', '2019-10-15 00:00:00'],
            ['2019-11-30 00:00:00', 'P1M', '2019-10-31 00:00:00'],

            ['2019-12-01 00:00:00', 'P1M', '2019-11-01 00:00:00'],
            ['2019-12-15 00:00:00', 'P1M', '2019-11-15 00:00:00'],
            ['2019-12-31 00:00:00', 'P1M', '2019-11-30 00:00:00'],
        ];

        try {
            foreach ($dataSet as $item) {
                Assertion::eq(
                    $this->modify(
                        $item[0],
                        $item[1]
                    ),
                    $item[2]
                );
            }
        } catch (\Exception $e) {
            throw new FailureException($e->getMessage());
        }
    }


    function it_adds_one_month()
    {
        // Initial, Inteval, ExpectedResult
        $dataSet = [
            ['2019-01-01 00:00:00', 'P1M', '2019-02-01 00:00:00'],
            ['2019-01-15 00:00:00', 'P1M', '2019-02-15 00:00:00'],
            ['2019-01-31 00:00:00', 'P1M', '2019-02-28 00:00:00'],

            ['2019-02-01 00:00:00', 'P1M', '2019-03-01 00:00:00'],
            ['2019-02-15 00:00:00', 'P1M', '2019-03-15 00:00:00'],
            ['2019-02-28 00:00:00', 'P1M', '2019-03-31 00:00:00'],

            ['2019-03-01 00:00:00', 'P1M', '2019-04-01 00:00:00'],
            ['2019-03-15 00:00:00', 'P1M', '2019-04-15 00:00:00'],
            ['2019-03-31 00:00:00', 'P1M', '2019-04-30 00:00:00'],

            ['2019-04-01 00:00:00', 'P1M', '2019-05-01 00:00:00'],
            ['2019-04-15 00:00:00', 'P1M', '2019-05-15 00:00:00'],
            ['2019-04-30 00:00:00', 'P1M', '2019-05-31 00:00:00'],

            ['2019-05-01 00:00:00', 'P1M', '2019-06-01 00:00:00'],
            ['2019-05-15 00:00:00', 'P1M', '2019-06-15 00:00:00'],
            ['2019-05-31 00:00:00', 'P1M', '2019-06-30 00:00:00'],

            ['2019-06-01 00:00:00', 'P1M', '2019-07-01 00:00:00'],
            ['2019-06-15 00:00:00', 'P1M', '2019-07-15 00:00:00'],
            ['2019-06-30 00:00:00', 'P1M', '2019-07-31 00:00:00'],

            ['2019-07-01 00:00:00', 'P1M', '2019-08-01 00:00:00'],
            ['2019-07-15 00:00:00', 'P1M', '2019-08-15 00:00:00'],
            ['2019-07-31 00:00:00', 'P1M', '2019-08-31 00:00:00'],

            ['2019-08-01 00:00:00', 'P1M', '2019-09-01 00:00:00'],
            ['2019-08-15 00:00:00', 'P1M', '2019-09-15 00:00:00'],
            ['2019-08-31 00:00:00', 'P1M', '2019-09-30 00:00:00'],

            ['2019-09-01 00:00:00', 'P1M', '2019-10-01 00:00:00'],
            ['2019-09-15 00:00:00', 'P1M', '2019-10-15 00:00:00'],
            ['2019-09-30 00:00:00', 'P1M', '2019-10-31 00:00:00'],

            ['2019-10-01 00:00:00', 'P1M', '2019-11-01 00:00:00'],
            ['2019-10-15 00:00:00', 'P1M', '2019-11-15 00:00:00'],
            ['2019-10-31 00:00:00', 'P1M', '2019-11-30 00:00:00'],

            ['2019-11-01 00:00:00', 'P1M', '2019-12-01 00:00:00'],
            ['2019-11-15 00:00:00', 'P1M', '2019-12-15 00:00:00'],
            ['2019-11-30 00:00:00', 'P1M', '2019-12-31 00:00:00'],

            ['2019-12-01 00:00:00', 'P1M', '2020-01-01 00:00:00'],
            ['2019-12-15 00:00:00', 'P1M', '2020-01-15 00:00:00'],
            ['2019-12-31 00:00:00', 'P1M', '2020-01-31 00:00:00'],
        ];

        try {
            foreach ($dataSet as $item) {
                Assertion::eq(
                    $this->modify(
                        $item[0],
                        $item[1],
                        'add'
                    ),
                    $item[2]
                );
            }
        } catch (\Exception $e) {
            throw new FailureException($e->getMessage());
        }
    }

    protected function modify(string $dateTime, string $interval, string $method = 'sub'): string
    {
        $dateTime = new \DateTime($dateTime);
        $interval = new \DateInterval($interval);

        return $this
            ->callOnWrappedObject(
                $method,
                [$dateTime, $interval]
            )
            ->getWrappedObject()
            ->format('Y-m-d H:i:s');
    }
}
