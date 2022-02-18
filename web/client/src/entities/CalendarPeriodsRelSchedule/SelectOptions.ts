import { CancelToken } from 'axios';
import defaultEntityBehavior, { FetchFksCallback } from 'lib/entities/DefaultEntityBehavior';
import calendarPeriodsRelSchedule from './CalendarPeriodsRelSchedule';
import Schedule from '../Schedule/Schedule';

const CalendarPeriodsRelScheduleSelectOptions = (callback: FetchFksCallback, cancelToken?: CancelToken): Promise<unknown> => {

    return defaultEntityBehavior.fetchFks(
        calendarPeriodsRelSchedule.path,
        ['id', 'schedule'],
        (data: any) => {

            const options: any = {};
            for (const item of data) {
                options[item.id] = Schedule.toStr(item.schedule);
            }

            callback(options);
        },
        cancelToken
    );
}

export default CalendarPeriodsRelScheduleSelectOptions;