import defaultEntityBehavior, { FetchFksCallback } from 'lib/entities/DefaultEntityBehavior';

const ResidentialDeviceSelectOptions = (callback: FetchFksCallback): void => {

    defaultEntityBehavior.fetchFks(
        '/residential_devices',
        ['id', 'name'],
        (data: any) => {

            const options: any = {};
            for (const item of data) {
                options[item.id] = item.name;
            }

            callback(options);
        }
    );
}

export default ResidentialDeviceSelectOptions;