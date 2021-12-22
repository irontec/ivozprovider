import defaultEntityBehavior, { EntityFormProps, FieldsetGroups } from 'lib/entities/DefaultEntityBehavior';
import { useEffect, useState } from 'react';
import ExternalCallFilterSelectOptions from 'entities/ExternalCallFilter/SelectOptions';
import UserSelectOptions from 'entities/User/SelectOptions';
import IvrSelectOptions from 'entities/Ivr/SelectOptions';
import HuntGroupSelectOptions from 'entities/HuntGroup/SelectOptions';
import FaxSelectOptions from 'entities/Fax/SelectOptions';
import ConferenceRoomSelectOptions from 'entities/ConferenceRoom/SelectOptions';
import ResidentialDeviceSelectOptions from 'entities/ResidentialDevice/SelectOptions';
import CountrySelectOptions from 'entities/Country/SelectOptions';
import LanguageSelectOptions from 'entities/Language/SelectOptions';
import QueueSelectOptions from 'entities/Queue/SelectOptions';
import ConditionalRouteSelectOptions from 'entities/ConditionalRoute/SelectOptions';
import RetailAccountSelectOptions from 'entities/RetailAccount/SelectOptions';
import _ from 'lib/services/translations/translate';
import { DdiPropertyList } from './DdiProperties';

export const foreignKeyGetter = async (): Promise<any> => {

    const response: DdiPropertyList<unknown> = {};
    const promises: Array<Promise<unknown>> = [];

    promises[promises.length] = ExternalCallFilterSelectOptions((options: any) => {
        response.externalCallFilter = options;
    });

    promises[promises.length] = UserSelectOptions((options: any) => {
        response.user = options;
    });

    promises[promises.length] = IvrSelectOptions((options: any) => {
        response.ivr = options;
    });

    promises[promises.length] = HuntGroupSelectOptions((options: any) => {
        response.huntGroup = options;
    });

    promises[promises.length] = FaxSelectOptions((options: any) => {
        response.fax = options;
    });

    promises[promises.length] = ConferenceRoomSelectOptions((options: any) => {
        response.conferenceRoom = options;
    });

    promises[promises.length] = ResidentialDeviceSelectOptions((options: any) => {
        response.residentialDevice = options;
    });

    promises[promises.length] = CountrySelectOptions((options: any) => {
        response.country = options;
    });

    promises[promises.length] = LanguageSelectOptions((options: any) => {
        response.language = options;
    });

    promises[promises.length] = QueueSelectOptions((options: any) => {
        response.queue = options;
    });

    promises[promises.length] = ConditionalRouteSelectOptions((options: any) => {
        response.conditionalRoute = options;
    });

    promises[promises.length] = RetailAccountSelectOptions((options: any) => {
        response.retailAccount = options;
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
            legend: _('Number data'),
            fields: [
                'country',
                'ddi',
                'displayName',
                'language',
            ]
        },
        {
            legend: _('Filters data'),
            fields: [
                'externalCallFilter',
            ]
        },
        {
            legend: _('Routing configuration'),
            fields: [
                'routeType',
                'user',
                'fax',
                'ivr',
                'huntGroup',
                'conferenceRoom',
                'friendValue',
                'queue',
                'residentialDevice',
                'conditionalRoute',
                'retailAccount',
            ]
        },
        {
            legend: _('Recording data'),
            fields: [
                'recordCalls',
            ]
        },
    ];

    return (<DefaultEntityForm {...props} fkChoices={fkChoices} groups={groups} />);
}

export default Form;