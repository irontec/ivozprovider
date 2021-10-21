import defaultEntityBehavior, { FetchFksCallback } from 'lib/entities/DefaultEntityBehavior';
import Schedule from './Schedule';

const ScheduleSelectOptions = (callback: FetchFksCallback): void => {

    defaultEntityBehavior.fetchFks(
        Schedule.path,
        ['id', 'name'],
        (data: any) => {

            const options: any = {};
            for (const item of data) {
                options[item.id] = item.name;
            }

            callback(options);
        }
    );
}

export default ScheduleSelectOptions;