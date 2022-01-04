import defaultEntityBehavior, { EntityFormProps, FieldsetGroups } from 'lib/entities/DefaultEntityBehavior';
import { useEffect, useState } from 'react';
import LocutionSelectOptions from 'entities/Locution/SelectOptions';
import IvrSelectOptions from 'entities/Ivr/SelectOptions';
import HuntGroupSelectOptions from 'entities/HuntGroup/SelectOptions';
import UserSelectOptions from 'entities/User/SelectOptions';
import CountrySelectOptions from 'entities/Country/SelectOptions';
import QueueSelectOptions from 'entities/Queue/SelectOptions';
import ConferenceRoomSelectOptions from 'entities/ConferenceRoom/SelectOptions';
import ExtensionSelectOptions from 'entities/Extension/SelectOptions';
import _ from 'lib/services/translations/translate';
import { ConditionalRoutePropertyList } from './ConditionalRouteProperties';
import axios, { CancelToken } from 'axios';
import { ForeignKeyGetterType } from 'lib/entities/EntityInterface';

export const foreignKeyGetter: ForeignKeyGetterType = async (token?: CancelToken): Promise<any> => {

    const response: ConditionalRoutePropertyList<unknown> = {};
    const promises: Array<Promise<unknown>> = [];

    promises[promises.length] = LocutionSelectOptions(
        (options: any) => {
            response.locution = options;
        },
        token
    );

    promises[promises.length] = IvrSelectOptions(
        (options: any) => {
            response.ivr = options;
        },
        token
    );

    promises[promises.length] = HuntGroupSelectOptions(
        (options: any) => {
            response.huntGroup = options;
        },
        token
    );

    promises[promises.length] = UserSelectOptions(
        (options: any) => {
            response.voicemailUser = options;
            response.user = options;
        },
        token
    );

    promises[promises.length] = CountrySelectOptions(
        (options: any) => {
            response.numberCountry = options;
        },
        token
    );

    promises[promises.length] = QueueSelectOptions(
        (options: any) => {
            response.queue = options;
        },
        token
    );

    promises[promises.length] = ConferenceRoomSelectOptions(
        (options: any) => {
            response.conferenceRoom = options;
        },
        token
    );

    promises[promises.length] = ExtensionSelectOptions(
        (options: any) => {
            response.extension = options;
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
                'name',
            ]
        },
        {
            legend: _('No matching condition handler'),
            fields: [
                'locution',
                'routetype',
                'ivr',
                'huntGroup',
                'voicemailUser',
                'user',
                'numberCountry',
                'numbervalue',
                'friendvalue',
                'queue',
                'conferenceRoom',
                'extension',
            ]
        },
    ];

    return (<DefaultEntityForm {...props} fkChoices={fkChoices} groups={groups} />);
}

export default Form;