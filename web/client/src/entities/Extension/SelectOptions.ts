import defaultEntityBehavior from 'lib/entities/DefaultEntityBehavior';
import { SelectOptionsType } from 'lib/entities/EntityInterface';
import Extension from './Extension';

const ExtensionSelectOptions: SelectOptionsType = ({callback, cancelToken}): Promise<unknown> => {

    return defaultEntityBehavior.fetchFks(
        Extension.path,
        ['id', 'number'],
        (data: any) => {

            const options: any = {};
            for (const item of data) {
                options[item.id] = item.number;
            }

            callback(options);
        },
        cancelToken
    );
}

export default ExtensionSelectOptions;