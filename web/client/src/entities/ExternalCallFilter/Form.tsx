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
import axios, { CancelToken } from 'axios';
import { ForeignKeyGetterType } from 'lib/entities/EntityInterface';

export const foreignKeyGetter: ForeignKeyGetterType = async (token?: CancelToken): Promise<any> => {

    const response: ExternalCallFilterPropertyList<Array<string | number>> = {};
    const promises: Array<Promise<unknown>> = [];

    promises[promises.length] = LocutionSelectOptions(
        (options: any) => {
            response.welcomeLocution = options;
            response.holidayLocution = options;
            response.outOfScheduleLocution = options;
        },
        token
    );

    promises[promises.length] = CountrySelectOptions(
        (options: any) => {
            response.holidayNumberCountry = options;
            response.outOfScheduleNumberCountry = options;
        },
        token
    );

    promises[promises.length] = ExtensionSelectOptions(
        (options: any) => {
            response.holidayExtension = options;
            response.outOfScheduleExtension = options;
        },
        token
    );

    promises[promises.length] = UserSelectOptions(
        (options: any) => {
            response.holidayVoiceMailUser = options;
            response.outOfScheduleVoiceMailUser = options;
        },
        token
    );

    promises[promises.length] = MatchListSelectOptions(
        (options: any) => {
            response.whiteListIds = options;
            response.blackListIds = options;
        },
        token
    );

    promises[promises.length] = ScheduleSelectOptions(
        (options: any) => {
            response.scheduleIds = options;
        },
        token
    );

    promises[promises.length] = CalendarSelectOptions(
        (options: any) => {
            response.calendarIds = options;
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