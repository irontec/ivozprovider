import defaultEntityBehavior, { FetchFksCallback } from 'lib/entities/DefaultEntityBehavior';

const ExtensionSelectOptions = (callback: FetchFksCallback): Promise<unknown> => {

    return defaultEntityBehavior.fetchFks(
        '/extensions',
        ['id', 'number'],
        (data:any) => {

            const options:any = {};
            for (const item of data) {
                options[item.id] = item.number;
            }

            callback(options);
        }
    );
}

export default ExtensionSelectOptions;