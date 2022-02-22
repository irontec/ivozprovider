import TerminalSelectOptions from 'entities/Terminal/SelectOptions';
import CallAclSelectOptions from 'entities/CallAcl/SelectOptions';
import LocutionSelectOptions from 'entities/Locution/SelectOptions';
import OutgoingDdiRuleSelectOptions from 'entities/OutgoingDdiRule/SelectOptions';
import DdiSelectOptions from 'entities/Ddi/SelectOptions';
import TimezoneSelectOptions from 'entities/Timezone/SelectOptions';
import ExtensionSelectOptions from 'entities/Extension/SelectOptions';
import LanguageSelectOptions from 'entities/Language/SelectOptions';
import TransformationRuleSetSelectOptions from 'entities/TransformationRuleSet/SelectOptions';
import MatchListSelectOptions from 'entities/MatchList/SelectOptions';
import UserSelectOptions from './SelectOptions';
import PickUpGroupSelectOptions from 'entities/PickUpGroup/SelectOptions';
import { UserPropertyList } from './UserProperties';
import { ForeignKeyGetterType } from 'lib/entities/EntityInterface';

export const foreignKeyGetter: ForeignKeyGetterType = async ({cancelToken}): Promise<any> => {

    const response: UserPropertyList<unknown> = {};
    const promises: Array<Promise<unknown>> = [];

    promises[promises.length] = UserSelectOptions({
        callback: (options: any) => {
            response.bossAssistant = options;
        },
        cancelToken
    });

    promises[promises.length] = MatchListSelectOptions({
        callback: (options: any) => {
            response.bossAssistantWhiteList = options;
        },
        cancelToken
    });

    promises[promises.length] = TransformationRuleSetSelectOptions({
        callback: (options: any) => {
            response.transformationRuleSet = options;
        },
        cancelToken
    });

    promises[promises.length] = LanguageSelectOptions({
        callback: (options: any) => {
            response.language = options;
        },
        cancelToken
    });

    promises[promises.length] = ExtensionSelectOptions({
        callback: (options: any) => {
            response.extension = options;
        },
        cancelToken
    });

    promises[promises.length] = TimezoneSelectOptions({
        callback: (options: any) => {
            response.timezone = options;
        },
        cancelToken
    });

    promises[promises.length] = DdiSelectOptions({
        callback: (options: any) => {
            response.outgoingDdi = options;
        },
        cancelToken
    });

    promises[promises.length] = OutgoingDdiRuleSelectOptions({
        callback: (options: any) => {
            response.outgoingDdiRule = options;
        },
        cancelToken
    });

    promises[promises.length] = LocutionSelectOptions({
        callback: (options: any) => {
            response.voicemailLocution = options;
        },
        cancelToken
    });

    promises[promises.length] = TerminalSelectOptions({
        callback: (options: any) => {
            response.terminal = options;
        },
        cancelToken
    });

    promises[promises.length] = CallAclSelectOptions({
        callback: (options: any) => {
            response.callAcl = options;
        },
        cancelToken
    });

    promises[promises.length] = PickUpGroupSelectOptions({
        callback: (options: any) => {
            response.pickupGroupIds = options;
        },
        cancelToken
    });

    await Promise.all(promises);

    return response;
};