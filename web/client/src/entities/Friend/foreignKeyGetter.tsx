import CallAclSelectOptions from 'entities/CallAcl/SelectOptions';
import TransformationRuleSetSelectOptions from 'entities/TransformationRuleSet/SelectOptions';
import DdiSelectOptions from 'entities/Ddi/SelectOptions';
import LanguageSelectOptions from 'entities/Language/SelectOptions';
import { FriendPropertyList } from './FriendProperties';
import { CancelToken } from 'axios';
import { ForeignKeyGetterType } from 'lib/entities/EntityInterface';

export const foreignKeyGetter: ForeignKeyGetterType = async (token?: CancelToken): Promise<any> => {

    const response: FriendPropertyList<Array<string | number>> = {};
    const promises: Array<Promise<unknown>> = [];

    promises[promises.length] = CallAclSelectOptions(
        (options: any) => {
            response.callAcl = options;
        },
        token
    );

    promises[promises.length] = TransformationRuleSetSelectOptions(
        (options: any) => {
            response.transformationRuleSet = options;
        },
        token
    );

    promises[promises.length] = DdiSelectOptions(
        (options: any) => {
            response.outgoingDdi = options;
        },
        token
    );

    promises[promises.length] = LanguageSelectOptions(
        (options: any) => {
            response.language = options;
        },
        token
    );

    await Promise.all(promises);

    return response;
};