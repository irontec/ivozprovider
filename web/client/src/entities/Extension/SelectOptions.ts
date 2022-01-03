import defaultEntityBehavior, { FetchFksCallback } from 'lib/entities/DefaultEntityBehavior';
import Extension from './Extension';

const ExtensionSelectOptions = (callback: FetchFksCallback): Promise<unknown> => {

    return defaultEntityBehavior.fetchFks(
        Extension.path,
        ['id', 'number'],
        (data: any) => {

            const options: any = {};
            for (const item of data) {
                options[item.id] = item.number;
            }

            callback(options);
        }
    );
}

export default ExtensionSelectOptions;