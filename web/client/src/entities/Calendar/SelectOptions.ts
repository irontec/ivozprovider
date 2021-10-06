import defaultEntityBehavior, { FetchFksCallback } from 'lib/entities/DefaultEntityBehavior';
import Calendar from './Calendar';

const CalendarSelectOptions = (callback: FetchFksCallback ) => {

    defaultEntityBehavior.fetchFks(
        Calendar.path,
        ['id', 'name'],
        (data:any) => {

            const options:any = {};
            for (const item of data) {
                options[item.id] = item.name;
            }

            callback(options);
        }
    );
}

export default CalendarSelectOptions;