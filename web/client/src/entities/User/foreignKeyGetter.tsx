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
import { CancelToken } from 'axios';
import { ForeignKeyGetterType } from 'lib/entities/EntityInterface';

export const foreignKeyGetter: ForeignKeyGetterType = async (token?: CancelToken): Promise<any> => {

    const response: UserPropertyList<unknown> = {};
    const promises: Array<Promise<unknown>> = [];

    promises[promises.length] = UserSelectOptions(
        (options: any) => {
            response.bossAssistant = options;
        },
        token
    );

    promises[promises.length] = MatchListSelectOptions(
        (options: any) => {
            response.bossAssistantWhiteList = options;
        },
        token
    );

    promises[promises.length] = TransformationRuleSetSelectOptions(
        (options: any) => {
            response.transformationRuleSet = options;
        },
        token
    );

    promises[promises.length] = LanguageSelectOptions(
        (options: any) => {
            response.language = options;
        },
        token
    );

    promises[promises.length] = ExtensionSelectOptions(
        (options: any) => {
            response.extension = options;
        },
        token
    );

    promises[promises.length] = TimezoneSelectOptions(
        (options: any) => {
            response.timezone = options;
        },
        token
    );

    promises[promises.length] = DdiSelectOptions(
        (options: any) => {
            response.outgoingDdi = options;
        },
        token
    );

    promises[promises.length] = OutgoingDdiRuleSelectOptions(
        (options: any) => {
            response.outgoingDdiRule = options;
        },
        token
    );

    promises[promises.length] = LocutionSelectOptions(
        (options: any) => {
            response.voicemailLocution = options;
        },
        token
    );

    promises[promises.length] = TerminalSelectOptions(
        (options: any) => {
            response.terminal = options;
        },
        token
    );

    promises[promises.length] = CallAclSelectOptions(
        (options: any) => {
            response.callAcl = options;
        },
        token
    );

    promises[promises.length] = PickUpGroupSelectOptions(
        (options: any) => {
            response.pickupGroupIds = options;
        },
        token
    );

    await Promise.all(promises);

    return response;
};