import defaultEntityBehavior from '../DefaultEntityBehavior';

const ResidentialDeviceSelectOptions = (callback: Function) => {

    defaultEntityBehavior.fetchFks(
        '/residential_devices',
        ['id', 'name'],
        (data:any) => {

            const options:any = {};
            for (const item of data) {
                options[item.id] = item.name;
            }

            callback(options);
        }
    );
}

export default ResidentialDeviceSelectOptions;