import { SelectOptionsType } from 'lib/entities/EntityInterface';
import store from 'store';
import User from '../User';

const VoicemailEnabledSelectOptions: SelectOptionsType = (
    {callback, cancelToken}
): Promise<unknown> => {

    const params: any = {
        '_properties': ['id', 'name', 'lastname'],
        'voicemailEnabled': 1,
    };

    const getAction = store.getActions().api.get;
    return getAction({
        path: User.path,
        params,
        successCallback: async (data: any) => {
            const options: any = {};
            for (const item of data) {
                options[item.id] = `${item.name} ${item.lastname}`;
            }
            callback(options);
        },
        cancelToken
    });
}

export default VoicemailEnabledSelectOptions;