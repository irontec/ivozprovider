import defaultEntityBehavior from '../DefaultEntityBehavior';
import Service from './Service';

const ServiceSelectOptions = (callback: Function) => {

    defaultEntityBehavior.fetchFks(
        Service.path,
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