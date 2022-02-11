import DdiSelectOptions from 'entities/Ddi/SelectOptions';
import { FaxPropertyList } from './FaxProperties';
import { CancelToken } from 'axios';
import { ForeignKeyGetterType } from 'lib/entities/EntityInterface';

export const foreignKeyGetter: ForeignKeyGetterType = async (token?: CancelToken): Promise<any> => {

    const response: FaxPropertyList<Array<string | number>> = {};
    const promises: Array<Promise<unknown>> = [];

    promises[promises.length] = DdiSelectOptions(
        (options: any) => {
            response.outgoingDdi = options;
        },
        token
    );

    await Promise.all(promises);

    return response;
};