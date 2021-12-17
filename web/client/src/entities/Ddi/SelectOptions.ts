import defaultEntityBehavior, { FetchFksCallback } from 'lib/entities/DefaultEntityBehavior';

const DdiSelectOptions = (callback: FetchFksCallback): Promise<unknown> => {

    return defaultEntityBehavior.fetchFks(
        '/ddis',
        ['id', 'ddie164'],
        (data:any) => {

            const options:any = {};
            for (const item of data) {
                options[item.id] = item.ddie164;
            }

            callback(options);
        }
    );
}

export default DdiSelectOptions;