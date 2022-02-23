import defaultEntityBehavior from 'lib/entities/DefaultEntityBehavior';
import calendarPeriodsRelSchedule from './CalendarPeriodsRelSchedule';
import Schedule from '../Schedule/Schedule';
import { SelectOptionsType } from 'lib/entities/EntityInterface';

const CalendarPeriodsRelScheduleSelectOptions: SelectOptionsType = ({callback, cancelToken}): Promise<unknown> => {

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