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

export const foreignKeyGetter: ForeignKeyGetterType = async (cancelToken?: CancelToken): Promise<any> => {

    const response: ExternalCallFilterPropertyList<Array<string | number>> = {};
    const promises: Array<Promise<unknown>> = [];

    promises[promises.length] = LocutionSelectOptions({
        callback: (options: any) => {
            response.welcomeLocution = options;
            response.holidayLocution = options;
            response.outOfScheduleLocution = options;
        },
        cancelToken
    });

    promises[promises.length] = CountrySelectOptions({
        callback: (options: any) => {
            response.holidayNumberCountry = options;
            response.outOfScheduleNumberCountry = options;
        },
        cancelToken
    });

    promises[promises.length] = ExtensionSelectOptions({
        callback: (options: any) => {
            response.holidayExtension = options;
            response.outOfScheduleExtension = options;
        },
        cancelToken
    });

    promises[promises.length] = UserSelectOptions({
        callback: (options: any) => {
            response.holidayVoiceMailUser = options;
            response.outOfScheduleVoiceMailUser = options;
        },
        cancelToken
    });

    promises[promises.length] = MatchListSelectOptions({
        callback: (options: any) => {
            response.whiteListIds = options;
            response.blackListIds = options;
        },
        cancelToken
    });

    promises[promises.length] = ScheduleSelectOptions({
        callback: (options: any) => {
            response.scheduleIds = options;
        },
        cancelToken
    });

    promises[promises.length] = CalendarSelectOptions({
        callback: (options: any) => {
            response.calendarIds = options;
        },
        cancelToken
    });

    await Promise.all(promises);

    return response;
};