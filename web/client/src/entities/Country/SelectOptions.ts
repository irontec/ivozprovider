import defaultEntityBehavior from '../DefaultEntityBehavior';

const CountrySelectOptions = (callback: Function) => {

    defaultEntityBehavior.fetchFks(
        '/countries',
        ['id', 'name', 'countryCode'],
        (data:any) => {
            const options:any = {};
            for (const item of data) {
                //@TODO detect language
                options[item.id] = `${item.name.en} (${item.countryCode})`;
            }

            callback(options);
        }
    );
}

export default CountrySelectOptions;