import { SelectOptionsType } from 'lib/entities/EntityInterface';
import Voicemail from './Voicemail';
import store from "../../store";

const VoicemailSelectOptions: SelectOptionsType = ({callback, cancelToken}): Promise<unknown> => {

    const params: any = {
        '_properties': ['id', 'name' ],
        'enabled': 1,
    };

    const getAction = store.getActions().api.get;
    return getAction({
        path: Voicemail.path,
        params,
        successCallback: async (data: any) => {
            const options: any = {};
            for (const item of data) {
                options[item.id] = `${item.name}`;
            }
            callback(options);
        },
        cancelToken
    });
};

export default VoicemailSelectOptions;