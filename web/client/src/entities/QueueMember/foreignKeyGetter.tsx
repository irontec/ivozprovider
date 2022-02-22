import UserSelectOptions from 'entities/User/SelectOptions';
import { QueueMemberPropertyList } from './QueueMemberProperties';
import { CancelToken } from 'axios';
import { ForeignKeyGetterType } from 'lib/entities/EntityInterface';

export const foreignKeyGetter: ForeignKeyGetterType = async (cancelToken?: CancelToken): Promise<any> => {

    const response: QueueMemberPropertyList<Array<string | number>> = {};
    const promises: Array<Promise<unknown>> = [];

    promises[promises.length] = UserSelectOptions({
        callback: (options: any) => {
            response.user = options;
        },
        cancelToken
    });

    await Promise.all(promises);

    return response;
};