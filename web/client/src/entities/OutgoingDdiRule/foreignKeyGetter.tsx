import DdiSelectOptions from 'entities/Ddi/SelectOptions';
import { OutgoingDdiRulePropertyList } from './OutgoingDdiRuleProperties';
import { CancelToken } from 'axios';
import { ForeignKeyGetterType } from 'lib/entities/EntityInterface';

export const foreignKeyGetter: ForeignKeyGetterType = async (token?: CancelToken): Promise<any> => {

    const response: OutgoingDdiRulePropertyList<Array<string | number>> = {};
    const promises: Array<Promise<unknown>> = [];

    promises[promises.length] = DdiSelectOptions(
        (options: any) => {
            response.forcedDdi = options;
        },
        token
    );

    await Promise.all(promises);

    return response;
};