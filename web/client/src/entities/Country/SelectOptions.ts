import defaultEntityBehavior, { FetchFksCallback } from 'lib/entities/DefaultEntityBehavior';
import Country from './Country';

const CountrySelectOptions = (callback: FetchFksCallback): Promise<unknown> => {

    return defaultEntityBehavior.fetchFks(
        '/countries',
        ['id', 'name', 'countryCode'],
        (data:any) => {
            const options:any = {};
            for (const item of data) {
                options[item.id] = `${Country.toStr(item)} (${item.countryCode})`;
            }

            callback(options);
        }
    );
}

export default CountrySelectOptions;