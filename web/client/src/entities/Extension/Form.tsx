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

export const foreignKeyGetter = async (): Promise<any> => {

    const response: ExtensionPropertyList<Array<string | number>> = {};
    const promises: Array<Promise<unknown>> = [];

    promises[promises.length] = CountrySelectOptions((options: any) => {
        response.numberCountry = options;
    });

    promises[promises.length] = IvrSelectOptions((options: any) => {
        response.ivr = options;
    });

    promises[promises.length] = HuntGroupSelectOptions((options: any) => {
        response.huntGroup = options;
    });

    promises[promises.length] = ConferenceRoomSelectOptions((options: any) => {
        response.conferenceRoom = options;
    });

    promises[promises.length] = UserSelectOptions((options: any) => {
        response.user = options;
    });

    promises[promises.length] = QueueSelectOptions((options: any) => {
        response.queue = options;
    });

    promises[promises.length] = ConditionalRouteSelectOptions((options: any) => {
        response.conditionalRoute = options;
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