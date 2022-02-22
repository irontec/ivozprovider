import defaultEntityBehavior from 'lib/entities/DefaultEntityBehavior';
import { SelectOptionsType } from 'lib/entities/EntityInterface';
import CallForwardSetting from './CallForwardSetting';

const CallForwardSettingSelectOptions: SelectOptionsType = ({callback, cancelToken}): Promise<unknown> => {

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