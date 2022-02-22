import CountrySelectOptions from 'entities/Country/SelectOptions';
import UserSelectOptions from 'entities/User/SelectOptions';
import { HuntGroupsRelUserPropertyList } from './HuntGroupsRelUserProperties';
import { CancelToken } from 'axios';
import { ForeignKeyGetterType } from 'lib/entities/EntityInterface';

export const foreignKeyGetter: ForeignKeyGetterType = async (cancelToken?: CancelToken): Promise<any> => {

    const response: HuntGroupsRelUserPropertyList<Array<string | number>> = {};
    const promises: Array<Promise<unknown>> = [];

    promises[promises.length] = CountrySelectOptions({
        callback: (options: any) => {
            response.numberCountry = options;
        },
        cancelToken
    });

    promises[promises.length] = UserSelectOptions({
        callback: (options: any) => {
            response.user = options;
        },
        cancelToken
    });

    await Promise.all(promises);

    return response;
};