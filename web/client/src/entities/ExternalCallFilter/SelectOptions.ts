import defaultEntityBehavior from 'lib/entities/DefaultEntityBehavior';
import { SelectOptionsType } from 'lib/entities/EntityInterface';
import ExternalCallFilter from './ExternalCallFilter';

const ExternalCallFilterSelectOptions: SelectOptionsType = ({callback, cancelToken}): Promise<unknown> => {

    return defaultEntityBehavior.fetchFks(
        ExternalCallFilter.path,
        ['id', 'name'],
        (data:any) => {

            const options:any = {};
            for (const item of data) {
                options[item.id] = item.name;
            }

            callback(options);
        },
        cancelToken
    );
}

export default ExternalCallFilterSelectOptions;