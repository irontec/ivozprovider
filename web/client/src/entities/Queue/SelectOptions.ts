import defaultEntityBehavior from 'lib/entities/DefaultEntityBehavior';
import { SelectOptionsType } from 'lib/entities/EntityInterface';
import Queue from './Queue';

const QueueSelectOptions: SelectOptionsType = ({callback, cancelToken}): Promise<unknown> => {

    return defaultEntityBehavior.fetchFks(
        Queue.path,
        ['id', 'name'],
        (data: any) => {

            const options: any = {};
            for (const item of data) {
                options[item.id] = item.name;
            }

            callback(options);
        },
        cancelToken
    );
}

export default QueueSelectOptions;