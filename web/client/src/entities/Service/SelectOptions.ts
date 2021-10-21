import defaultEntityBehavior, { FetchFksCallback } from 'lib/entities/DefaultEntityBehavior';
import Service from './Service';

const ServiceSelectOptions = (callback: FetchFksCallback, includeId?: number): void => {

    let path = `${Service.path}/unassigned`;
    if (includeId) {
        path += `?_includeId=${includeId}`;
    }

    defaultEntityBehavior.fetchFks(
        path,
        ['id', 'name'],
        (data: any) => {
            const options: any = {};
            for (const item of data) {
                options[item.id] = Service.toStr(item);
            }

            callback(options);
        }
    );
}

export default ServiceSelectOptions;