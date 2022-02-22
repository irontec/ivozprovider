import UserSelectOptions from 'entities/User/SelectOptions';
import CountrySelectOptions from 'entities/Country/SelectOptions';
import ExtensionSelectOptions from 'entities/Extension/SelectOptions';
import { HolidayDatePropertyList } from './HolidayDateProperties';
import { CancelToken } from 'axios';
import { ForeignKeyGetterType } from 'lib/entities/EntityInterface';
import LocutionSelectOptions from 'entities/Locution/SelectOptions';

export const foreignKeyGetter: ForeignKeyGetterType = async (cancelToken?: CancelToken): Promise<any> => {

    const response: HolidayDatePropertyList<unknown> = {};
    const promises: Array<Promise<unknown>> = [];

    promises[promises.length] = LocutionSelectOptions({
        callback: (options: any) => {
            response.locution = options;
        },
        cancelToken
    });

    promises[promises.length] = CountrySelectOptions({
        callback: (options: any) => {
            response.numberCountry = options;
        },
        cancelToken
    });

    promises[promises.length] = UserSelectOptions({
        callback: (options: any) => {
            response.voiceMailUser = options;
        },
        cancelToken
    });

    promises[promises.length] = ExtensionSelectOptions({
        callback: (options: any) => {
            response.extension = options;
        },
        cancelToken
    });

    await Promise.all(promises);

    return response;
};