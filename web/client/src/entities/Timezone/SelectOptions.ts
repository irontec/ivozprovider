import defaultEntityBehavior from 'lib/entities/DefaultEntityBehavior';
import { SelectOptionsType } from 'lib/entities/EntityInterface';

const TimezoneSelectOptions: SelectOptionsType = ({callback, cancelToken}): Promise<unknown> => {

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