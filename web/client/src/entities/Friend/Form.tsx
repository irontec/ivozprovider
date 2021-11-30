import defaultEntityBehavior, { EntityFormProps, FieldsetGroups } from 'lib/entities/DefaultEntityBehavior';
import { useEffect, useState } from 'react';
import CallAclSelectOptions from 'entities/CallAcl/SelectOptions';
import TransformationRuleSetSelectOptions from 'entities/TransformationRuleSet/SelectOptions';
import DdiSelectOptions from 'entities/Ddi/SelectOptions';
import LanguageSelectOptions from 'entities/Language/SelectOptions';
import _ from 'lib/services/translations/translate';
import { FriendPropertyList } from './FriendProperties';

export const foreignKeyGetter = async (): Promise<any> => {

    const response: FriendPropertyList<Array<string | number>> = {};
    const promises: Array<Promise<unknown>> = [];

    promises[promises.length] = CallAclSelectOptions((options: any) => {
        response.callAcl = options;
    });

    promises[promises.length] = TransformationRuleSetSelectOptions((options: any) => {
        response.transformationRuleSet = options;
    });

    promises[promises.length] = DdiSelectOptions((options: any) => {
        response.outgoingDdi = options;
    });

    promises[promises.length] = LanguageSelectOptions((options: any) => {
        response.language = options;
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
            legend: _('Basic Configuration'),
            fields: [
                'directConnectivity',
                'priority',
                'description',
                'name',
                'password',
                'transport',
                'ip',
                'port',
                'alwaysApplyTransformations',
            ]
        },
        {
            legend: _('Geographic Configuration'),
            fields: [
                'language',
                'transformationRuleSet',
            ]
        },
        {
            legend: _('Outgoing Configuration'),
            fields: [
                'callAcl',
                'outgoingDdi',
            ]
        },
        {
            legend: _('Advanced Configuration'),
            fields: [
                'fromUser',
                'fromDomain',
                'allow',
                'ddiIn',
                't38Passthrough',
                'rtpEncryption',
                'multiContact',
            ]
        },
        {
            legend: '',
            fields: [
                'statusIcon',
            ]
        },
    ];

    return (<DefaultEntityForm {...props} fkChoices={fkChoices} groups={groups} />);
}

export default Form;