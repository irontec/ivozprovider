import { CancelToken } from 'axios';
import defaultEntityBehavior, { FetchFksCallback } from 'lib/entities/DefaultEntityBehavior';
import Service from './Service';

const ServiceSelectOptions = (callback: FetchFksCallback, includeId?: number, cancelToken?: CancelToken): Promise<unknown> => {

    let path = `${Service.path}/unassigned`;
    if (includeId) {
        path += `?_includeId=${includeId}`;
    }

    return defaultEntityBehavior.fetchFks(
        path,
        ['id', 'name'],
        (data: any) => {
            const options: any = {};
            for (const item of data) {
                options[item.id] = Service.toStr(item);
            }

            callback(options);
        },
        cancelToken
    );
}

export default ServiceSelectOptions;