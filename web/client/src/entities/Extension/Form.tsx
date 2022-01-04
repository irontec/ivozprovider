import defaultEntityBehavior, { EntityFormProps, FieldsetGroups } from 'lib/entities/DefaultEntityBehavior';
import { useEffect, useState } from 'react';
import CountrySelectOptions from 'entities/Country/SelectOptions';
import IvrSelectOptions from 'entities/Ivr/SelectOptions';
import HuntGroupSelectOptions from 'entities/HuntGroup/SelectOptions';
import ConferenceRoomSelectOptions from 'entities/ConferenceRoom/SelectOptions';
import UserSelectOptions from 'entities/User/SelectOptions';
import QueueSelectOptions from 'entities/Queue/SelectOptions';
import ConditionalRouteSelectOptions from 'entities/ConditionalRoute/SelectOptions';
import { ExtensionPropertyList } from './ExtensionProperties';
import axios, { CancelToken } from 'axios';
import { ForeignKeyGetterType } from 'lib/entities/EntityInterface';

export const foreignKeyGetter: ForeignKeyGetterType = async (token?: CancelToken): Promise<any> => {

    const response: ExtensionPropertyList<Array<string | number>> = {};
    const promises: Array<Promise<unknown>> = [];

    promises[promises.length] = CountrySelectOptions(
        (options: any) => {
            response.numberCountry = options;
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

    promises[promises.length] = ConferenceRoomSelectOptions(
        (options: any) => {
            response.conferenceRoom = options;
        },
        token
    );

    promises[promises.length] = UserSelectOptions(
        (options: any) => {
            response.user = options;
        },
        token
    );

    promises[promises.length] = QueueSelectOptions(
        (options: any) => {
            response.queue = options;
        },
        token
    );

    promises[promises.length] = ConditionalRouteSelectOptions(
        (options: any) => {
            response.conditionalRoute = options;
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
            legend: '',
            fields: [
                'number',
            ]
        },
        {
            legend: '',
            fields: [
                'routeType',
                'ivr',
                'huntGroup',
                'conferenceRoom',
                'user',
                'numberCountry',
                'numberValue',
                'friendValue',
                'queue',
                'conditionalRoute',
            ]
        },
    ];

    return (<DefaultEntityForm {...props} fkChoices={fkChoices} groups={groups} />);
}

export default Form;