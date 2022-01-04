import defaultEntityBehavior, { EntityFormProps, FieldsetGroups } from 'lib/entities/DefaultEntityBehavior';
import { useEffect, useState } from 'react';
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
import _ from 'lib/services/translations/translate';
import { UserPropertyList } from './UserProperties';
import axios, { CancelToken } from 'axios';
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

const Form = (props: EntityFormProps): JSX.Element => {

    const DefaultEntityForm = defaultEntityBehavior.Form;
    const [fkChoices, setFkChoices] = useState<any>({});

    useEffect(
        () => {

            let mounted = true;

            const CancelToken = axios.CancelToken;
            const source = CancelToken.source();

            foreignKeyGetter(source.token).then((options) => {

                if (!mounted) {
                    return;
                }

                setFkChoices((fkChoices: any) => {
                    return {
                        ...fkChoices,
                        ...options
                    }
                });
            });


            return () => {
                mounted = false;
                source.cancel();
            }
        },
        []
    );

    const edit = props.edit || false;
    const groups: Array<FieldsetGroups | false> = [
        {
            legend: _('Personal data'),
            fields: [
                'name',
                edit && 'language',
                'lastname',
                'email',
            ]
        },
        edit && {
            legend: _('Geographic Configuration'),
            fields: [
                edit && 'language',
                'timezone',
                'transformationRuleSet',
            ]
        },
        edit && {
            legend: _('Login Info'),
            fields: [
                'active',
                'pass',
                'gsQRCode',
            ]
        },
        edit && {
            legend: _('Boss-Assistant'),
            fields: [
                'isBoss',
                'bossAssistant',
                'bossAssistantWhiteList',
            ]
        },
        {
            legend: _('Basic Configuration'),
            fields: [
                'terminal',
                'extension',
                'outgoingDdi',
                'outgoingDdiRule',
                edit && 'callAcl',
                edit && 'doNotDisturb',
                edit && 'maxCalls',
                edit && 'externalIpCalls',
                edit && 'multiContact',
                edit && 'rejectCallMethod',
            ]
        },
        edit && {
            legend: _('Voicemail'),
            fields: [
                'voicemailEnabled',
                'voicemailLocution',
                'voicemailSendMail',
                'voicemailAttachSound',
            ]
        },
        edit && {
            legend: _('Group belonging'),
            fields: [
                'pickupGroupIds',
                //@TODO 'HuntGroupsRelUsers',
            ]
        }
    ];

    return (
        <DefaultEntityForm {...props} fkChoices={fkChoices} groups={groups} />
    );
}

export default Form;