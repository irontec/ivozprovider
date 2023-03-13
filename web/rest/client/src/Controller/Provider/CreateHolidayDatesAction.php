<?php

namespace Controller\Provider;

use Ivoz\Provider\Application\Service\HolidayDate\CreateHolidayDateRange;
use Ivoz\Provider\Domain\Model\HolidayDate\HolidayDateRange;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateHolidayDatesAction
{
    public function __construct(
        private CreateHolidayDateRange $createHolidayDateRange
    ) {
    }

    public function __invoke(Request $request): Response
    {
        $body = $request->toArray();
        $holidayDateRange = new HolidayDateRange(
            $body['name'],
            $body['wholeDayEvent'],
            $body['startDate'],
            $body['endDate'],
            $body['calendar'],
            $body['timeIn'],
            $body['timeOut'],
            $body['routeType'],
            $body['locution'],
        );

        try {
            $this->createHolidayDateRange->execute(
                $holidayDateRange
            );

            return new Response('Holiday Dates created', 201);
        } catch (\Exception $e) {
            return new Response('Cannot create holiday dates', 400);
        }
    }
}
