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
        /**
         * @var array{
         * calendar: int,
         * name: string,
         * startDate: string,
         * endDate: string,
         * wholeDayEvent: int,
         * locution?: int,
         * timeIn?: string,
         * timeOut?: string,
         * routeType?: string | null,
         * extension?: int | null,
         * voicemail?: int | null,
         * numberCountry?: int | null,
         * numberValue?: string,
         * } $body
         */
        $body = $request->toArray();

        $holidayDateRange = new HolidayDateRange(
            calendar: $body['calendar'],
            name: $body['name'],
            startDate: $body['startDate'],
            endDate: $body['endDate'],
            wholeDayEvent: $body['wholeDayEvent'],
            locution: $body['locution'] ?? null,
            timeIn: $body['timeIn'] ?? null,
            timeOut: $body['timeOut'] ?? null,
            routeType: $body['routeType'] ?? null,
            extension: $body['extension'] ?? null,
            voicemail: $body['voicemail'] ?? null,
            numberCountry: $body['numberCountry'] ?? null,
            numberValue: $body['numberValue'] ?? null,
        );

        try {
            $this->createHolidayDateRange->execute(
                $holidayDateRange
            );

            return new Response('Holiday Dates created', 201);
        } catch (\DomainException $e) {
            throw $e;
        } catch (\Exception $e) {
            return new Response('Cannot create holiday dates', 400);
        }
    }
}
