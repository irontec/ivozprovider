import DdiSelectOptions from 'entities/Ddi/SelectOptions';
import { OutgoingDdiRulePropertyList } from './OutgoingDdiRuleProperties';
import { ForeignKeyGetterType } from 'lib/entities/EntityInterface';

export const foreignKeyGetter: ForeignKeyGetterType = async ({cancelToken}): Promise<any> => {

    const response: OutgoingDdiRulePropertyList<Array<string | number>> = {};
    const promises: Array<Promise<unknown>> = [];

    promises[promises.length] = DdiSelectOptions({
        callback: (options: any) => {
            response.forcedDdi = options;
        },
        cancelToken
    });

    await Promise.all(promises);

    return response;
};