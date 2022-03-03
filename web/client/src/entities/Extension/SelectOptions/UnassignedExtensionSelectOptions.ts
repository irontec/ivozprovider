import { SelectOptionsType } from 'lib/entities/EntityInterface';
import store from 'store';
import Extension from '../Extension';

type CustomPropsType = {
    _includeId: number,
}

const UnassignedExtensionSelectOptions: SelectOptionsType<CustomPropsType> = (
    {callback, cancelToken},
    customProps
): Promise<unknown> => {

    const params: any = {
        '_properties': ['id', 'number']
    };
    const _includeId = customProps?._includeId;
    if (_includeId) {
        params._includeId = _includeId;
    }

    const getAction = store.getActions().api.get;
    return getAction({
        path: Extension.path + '/unassigned',
        params,
        successCallback: async (data: any) => {
            const options: any = {};
            for (const item of data) {
                options[item.id] = item.number;
            }
            callback(options);
        },
        cancelToken
    });

}

export default UnassignedExtensionSelectOptions;