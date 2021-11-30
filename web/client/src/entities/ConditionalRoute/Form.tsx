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

export const foreignKeyGetter = async (): Promise<any> => {

    const response: ConditionalRoutePropertyList<unknown> = {};
    const promises: Array<Promise<unknown>> = [];

    promises[promises.length] = LocutionSelectOptions((options: any) => {
        response.locution = options;
    });

    promises[promises.length] = IvrSelectOptions((options: any) => {
        response.ivr = options;
    });

    promises[promises.length] = HuntGroupSelectOptions((options: any) => {
        response.huntGroup = options;
    });

    promises[promises.length] = UserSelectOptions((options: any) => {
        response.voicemailUser = options;
        response.user = options;
    });

    promises[promises.length] = CountrySelectOptions((options: any) => {
        response.numberCountry = options;
    });

    promises[promises.length] = QueueSelectOptions((options: any) => {
        response.queue = options;
    });

    promises[promises.length] = ConferenceRoomSelectOptions((options: any) => {
        response.conferenceRoom = options;
    });

    promises[promises.length] = ExtensionSelectOptions((options: any) => {
        response.extension = options;
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