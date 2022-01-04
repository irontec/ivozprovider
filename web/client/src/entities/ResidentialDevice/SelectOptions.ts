import { CancelToken } from 'axios';
import defaultEntityBehavior, { FetchFksCallback } from 'lib/entities/DefaultEntityBehavior';
import ResidentialDevice from './ResidentialDevice';

const ResidentialDeviceSelectOptions = (callback: FetchFksCallback, cancelToken?: CancelToken): Promise<unknown> => {

    return defaultEntityBehavior.fetchFks(
        ResidentialDevice.path,
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

export default ResidentialDeviceSelectOptions;