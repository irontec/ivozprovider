import defaultEntityBehavior, { FetchFksCallback } from 'lib/entities/DefaultEntityBehavior';

const ExternalCallFilterSelectOptions = (callback: FetchFksCallback): Promise<unknown> => {

    return defaultEntityBehavior.fetchFks(
        '/external_call_filters',
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

export default ExternalCallFilterSelectOptions;