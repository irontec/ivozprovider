import UserSelectOptions from 'entities/User/SelectOptions';
import { CalendarPeriodPropertyList } from './CalendarPeriodProperties';
import { ForeignKeyGetterType } from 'lib/entities/EntityInterface';
import { CancelToken } from 'axios';
import LocutionSelectOptions from 'entities/Locution/SelectOptions';
import CountrySelectOptions from 'entities/Country/SelectOptions';
import ExtensionSelectOptions from 'entities/Extension/SelectOptions';
import ScheduleSelectOptions from 'entities/Schedule/SelectOptions';

export const foreignKeyGetter: ForeignKeyGetterType = async (token?: CancelToken): Promise<any> => {

    const response: CalendarPeriodPropertyList<unknown> = {};
    const promises: Array<Promise<unknown>> = [];

    promises[promises.length] = LocutionSelectOptions(
        (options: any) => {
            response.locution = options;
        },
        token
    );

    promises[promises.length] = CountrySelectOptions(
        (options: any) => {
            response.numberCountry = options;
        },
        token
    );

    promises[promises.length] = UserSelectOptions(
        (options: any) => {
            response.voiceMailUser = options;
        },
        token
    );

    promises[promises.length] = ExtensionSelectOptions(
        (options: any) => {
            response.extension = options;
        },
        token
    );

    promises[promises.length] = ScheduleSelectOptions(
        (options: any) => {
            response.scheduleIds = options;
        },
        token
    );

    await Promise.all(promises);

    return response;
};