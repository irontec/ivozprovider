import defaultEntityBehavior from 'lib/entities/DefaultEntityBehavior';
import Service from './Service';

const ServiceSelectOptions = (callback: Function, includeId?: number) => {

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