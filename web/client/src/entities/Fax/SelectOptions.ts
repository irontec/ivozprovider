import defaultEntityBehavior, { FetchFksCallback } from 'lib/entities/DefaultEntityBehavior';

const FaxSelectOptions = (callback: FetchFksCallback): Promise<unknown> => {

    return defaultEntityBehavior.fetchFks(
        '/faxes',
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

export default FaxSelectOptions;