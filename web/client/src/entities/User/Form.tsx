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

export const foreignKeyGetter = async (): Promise<any> => {

    const response: UserPropertyList<unknown> = {};
    const promises: Array<Promise<unknown>> = [];

    promises[promises.length] = UserSelectOptions((options: any) => {
        response.bossAssistant = options;
    });

    promises[promises.length] = MatchListSelectOptions((options: any) => {
        response.bossAssistantWhiteList = options;
    });

    promises[promises.length] = TransformationRuleSetSelectOptions((options: any) => {
        response.transformationRuleSet = options;
    });

    promises[promises.length] = LanguageSelectOptions((options: any) => {
        response.language = options;
    });

    promises[promises.length] = ExtensionSelectOptions((options: any) => {
        response.extension = options;
    });

    promises[promises.length] = TimezoneSelectOptions((options: any) => {
        response.timezone = options;
    });

    promises[promises.length] = DdiSelectOptions((options: any) => {
        response.outgoingDdi = options;
    });

    promises[promises.length] = OutgoingDdiRuleSelectOptions((options: any) => {
        response.outgoingDdiRule = options;
    });

    promises[promises.length] = LocutionSelectOptions((options: any) => {
        response.voicemailLocution = options;
    });

    promises[promises.length] = TerminalSelectOptions((options: any) => {
        response.terminal = options;
    });

    promises[promises.length] = CallAclSelectOptions((options: any) => {
        response.callAcl = options;
    });

    promises[promises.length] = PickUpGroupSelectOptions((options: any) => {
        response.pickupGroupIds = options;
    });

    await Promise.all(promises);

    return response;
};

const Form = (props: EntityFormProps): JSX.Element => {

    const DefaultEntityForm = defaultEntityBehavior.Form;

    const [fkChoices, setFkChoices] = useState<any>({});
    const [mounted, setMounted] = useState<boolean>(true);
    const [loadingFks, setLoadingFks] = useState<boolean>(true);

    useEffect(
        () => {

            if (mounted && loadingFks) {

                foreignKeyGetter().then((options) => {
                    mounted && setFkChoices((fkChoices: any) => {
                        return {
                            ...fkChoices,
                            ...options
                        }
                    });
                });

                setLoadingFks(false);
            }

            return function umount() {
                setMounted(false);
            };
        },
        [mounted, loadingFks, fkChoices]
    );

    const groups: Array<FieldsetGroups> = [
        {
            legend: _('Personal data'),
            fields: [
                'name',
                'language',
                'lastname',
                'email',
            ]
        },
        {
            legend: _('Geographic Configuration'),
            fields: [
                //'language',
                'timezone',
                'transformationRuleSet',
            ]
        },
        {
            legend: _('Login Info'),
            fields: [
                'active',
                'pass',
                'gsQRCode',
            ]
        },
        {
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
                'callAcl',
                'doNotDisturb',
                'maxCalls',
                'externalIpCalls',
                'multiContact',
                'rejectCallMethod',
            ]
        },
        {
            legend: _('Voicemail'),
            fields: [
                'voicemailEnabled',
                'voicemailLocution',
                'voicemailSendMail',
                'voicemailAttachSound',
            ]
        },
        {
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