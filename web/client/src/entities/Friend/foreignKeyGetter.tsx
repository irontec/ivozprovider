import CallAclSelectOptions from 'entities/CallAcl/SelectOptions';
import TransformationRuleSetSelectOptions from 'entities/TransformationRuleSet/SelectOptions';
import DdiSelectOptions from 'entities/Ddi/SelectOptions';
import LanguageSelectOptions from 'entities/Language/SelectOptions';
import { FriendPropertyList } from './FriendProperties';
import { ForeignKeyGetterType } from 'lib/entities/EntityInterface';

export const foreignKeyGetter: ForeignKeyGetterType = async ({cancelToken}): Promise<any> => {

    const response: FriendPropertyList<Array<string | number>> = {};
    const promises: Array<Promise<unknown>> = [];

    promises[promises.length] = CallAclSelectOptions({
        callback: (options: any) => {
            response.callAcl = options;
        },
        cancelToken
    });

    promises[promises.length] = TransformationRuleSetSelectOptions({
        callback: (options: any) => {
            response.transformationRuleSet = options;
        },
        cancelToken
    });

    promises[promises.length] = DdiSelectOptions({
        callback: (options: any) => {
            response.outgoingDdi = options;
        },
        cancelToken
    });

    promises[promises.length] = LanguageSelectOptions({
        callback: (options: any) => {
            response.language = options;
        },
        cancelToken
    });

    await Promise.all(promises);

    return response;
};