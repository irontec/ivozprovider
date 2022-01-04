import { CancelToken } from 'axios';
import defaultEntityBehavior, { FetchFksCallback } from 'lib/entities/DefaultEntityBehavior';
import RoutingTag from './RoutingTag';

const RoutingTagSelectOptions = (callback: FetchFksCallback, cancelToken?: CancelToken): Promise<unknown> => {

    return defaultEntityBehavior.fetchFks(
        RoutingTag.path,
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

export default RoutingTagSelectOptions;