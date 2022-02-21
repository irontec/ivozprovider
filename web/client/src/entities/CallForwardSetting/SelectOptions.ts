import { CancelToken } from 'axios';
import defaultEntityBehavior, { FetchFksCallback } from 'lib/entities/DefaultEntityBehavior';
import CallForwardSetting from './CallForwardSetting';

const CallForwardSettingSelectOptions = (callback: FetchFksCallback, cancelToken?: CancelToken): Promise<unknown> => {

    return defaultEntityBehavior.fetchFks(
        CallForwardSetting.path,
        ['id'],
        (data: any) => {

            const options: any = {};
            for (const item of data) {
                options[item.id] = item.id;
            }

            callback(options);
        },
        cancelToken
    );
}

export default CallForwardSettingSelectOptions;