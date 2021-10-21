import defaultEntityBehavior, { FetchFksCallback } from 'lib/entities/DefaultEntityBehavior';

const TimezoneSelectOptions = (callback: FetchFksCallback): void => {

    defaultEntityBehavior.fetchFks(
        '/timezones',
        ['id', 'tz'],
        (data: any) => {

            const options: any = {};
            for (const item of data) {
                options[item.id] = item.tz;
            }

            callback(options);
        }
    );
}

export default TimezoneSelectOptions;