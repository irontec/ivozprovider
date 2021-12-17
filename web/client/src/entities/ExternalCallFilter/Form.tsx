import defaultEntityBehavior, { EntityFormProps, FieldsetGroups } from 'lib/entities/DefaultEntityBehavior';
import { useEffect, useState } from 'react';
import LocutionSelectOptions from 'entities/Locution/SelectOptions';
import CountrySelectOptions from 'entities/Country/SelectOptions';
import ExtensionSelectOptions from 'entities/Extension/SelectOptions';
import UserSelectOptions from 'entities/User/SelectOptions';
import _ from 'lib/services/translations/translate';
import MatchListSelectOptions from 'entities/MatchList/SelectOptions';
import ScheduleSelectOptions from 'entities/Schedule/SelectOptions';
import CalendarSelectOptions from 'entities/Calendar/SelectOptions';
import { ExternalCallFilterPropertyList } from './ExternalCallFilterProperties';

export const foreignKeyGetter = async (): Promise<any> => {

    const response: ExternalCallFilterPropertyList<Array<string | number>> = {};
    const promises: Array<Promise<unknown>> = [];

    promises[promises.length] = LocutionSelectOptions((options: any) => {
        response.welcomeLocution = options;
        response.holidayLocution = options;
        response.outOfScheduleLocution = options;
    });

    promises[promises.length] = CountrySelectOptions((options: any) => {
        response.holidayNumberCountry = options;
        response.outOfScheduleNumberCountry = options;
    });

    promises[promises.length] = ExtensionSelectOptions((options: any) => {
        response.holidayExtension = options;
        response.outOfScheduleExtension = options;
    });

    promises[promises.length] = UserSelectOptions((options: any) => {
        response.holidayVoiceMailUser = options;
        response.outOfScheduleVoiceMailUser = options;
    });

    promises[promises.length] = MatchListSelectOptions((options: any) => {
        response.whiteListIds = options;
        response.blackListIds = options;
    });

    promises[promises.length] = ScheduleSelectOptions((options: any) => {
        response.scheduleIds = options;
    });

    promises[promises.length] = CalendarSelectOptions((options: any) => {
        response.calendarIds = options;
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
            legend: _('Basic Info'),
            fields: [
                'name',
                'welcomeLocution',
            ]
        },
        {
            legend: _('Filtering info'),
            fields: [
                'whiteListIds',
                'blackListIds',
            ]
        },
        {
            legend: _('Holidays configuration'),
            fields: [
                'calendarIds',
                'holidayLocution',
                'holidayTargetType',
                'holidayNumberCountry',
                'holidayNumberValue',
                'holidayExtension',
                'holidayVoiceMailUser',
            ]
        },
        {
            legend: _('Out of schedule configuration'),
            fields: [
                'scheduleIds',
                'outOfScheduleLocution',
                'outOfScheduleTargetType',
                'outOfScheduleNumberCountry',
                'outOfScheduleNumberValue',
                'outOfScheduleExtension',
                'outOfScheduleVoiceMailUser',
            ]
        },
    ];

    return (<DefaultEntityForm {...props} fkChoices={fkChoices} groups={groups} />);
}

export default Form;