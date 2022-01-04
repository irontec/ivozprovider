import { CancelToken } from 'axios';
import defaultEntityBehavior, { FetchFksCallback } from 'lib/entities/DefaultEntityBehavior';
import Country from './Country';

const CountrySelectOptions = (callback: FetchFksCallback, cancelToken?: CancelToken): Promise<unknown> => {

    return defaultEntityBehavior.fetchFks(
        Country.path,
        ['id', 'name', 'countryCode'],
        (data: any) => {
            const options: any = {};
            for (const item of data) {
                options[item.id] = `${Country.toStr(item)} (${item.countryCode})`;
            }

            callback(options);
        },
        cancelToken
    );
}

export default CountrySelectOptions;