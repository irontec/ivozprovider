import LocutionSelectOptions from 'entities/Locution/SelectOptions';
import CountrySelectOptions from 'entities/Country/SelectOptions';
import ExtensionSelectOptions from 'entities/Extension/SelectOptions';
import UserSelectOptions from 'entities/User/SelectOptions';
import MatchListSelectOptions from 'entities/MatchList/SelectOptions';
import ScheduleSelectOptions from 'entities/Schedule/SelectOptions';
import CalendarSelectOptions from 'entities/Calendar/SelectOptions';
import { ExternalCallFilterPropertyList } from './ExternalCallFilterProperties';
import { CancelToken } from 'axios';
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