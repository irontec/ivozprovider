import defaultEntityBehavior, { EntityFormProps, FieldsetGroups } from 'lib/entities/DefaultEntityBehavior';
import { useEffect, useState } from 'react';
import CallAclSelectOptions from 'entities/CallAcl/SelectOptions';
import TransformationRuleSetSelectOptions from 'entities/TransformationRuleSet/SelectOptions';
import DdiSelectOptions from 'entities/Ddi/SelectOptions';
import LanguageSelectOptions from 'entities/Language/SelectOptions';
import _ from 'lib/services/translations/translate';
import { FriendPropertyList } from './FriendProperties';
import axios, { CancelToken } from 'axios';
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