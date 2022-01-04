import { CancelToken } from 'axios';
import defaultEntityBehavior, { FetchFksCallback } from 'lib/entities/DefaultEntityBehavior';

const TimezoneSelectOptions = (callback: FetchFksCallback, cancelToken?: CancelToken): Promise<unknown> => {

    return defaultEntityBehavior.fetchFks(
        '/timezones',
        ['id', 'tz'],
        (data: any) => {

            const options: any = {};
            for (const item of data) {
                options[item.id] = item.tz;
            }

            callback(options);
        },
        cancelToken
    );
}

export default TimezoneSelectOptions;