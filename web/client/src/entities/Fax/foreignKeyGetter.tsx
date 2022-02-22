import DdiSelectOptions from 'entities/Ddi/SelectOptions';
import { FaxPropertyList } from './FaxProperties';
import { ForeignKeyGetterType } from 'lib/entities/EntityInterface';

export const foreignKeyGetter: ForeignKeyGetterType = async ({cancelToken}): Promise<any> => {

    const response: FaxPropertyList<Array<string | number>> = {};
    const promises: Array<Promise<unknown>> = [];

    promises[promises.length] = DdiSelectOptions({
        callback: (options: any) => {
            response.outgoingDdi = options;
        },
        cancelToken
    });

    await Promise.all(promises);

    return response;
};