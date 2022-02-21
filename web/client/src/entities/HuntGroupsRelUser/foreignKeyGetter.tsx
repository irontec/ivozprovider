import CountrySelectOptions from 'entities/Country/SelectOptions';
import UserSelectOptions from 'entities/User/SelectOptions';
import { HuntGroupsRelUserPropertyList } from './HuntGroupsRelUserProperties';
import { CancelToken } from 'axios';
import { ForeignKeyGetterType } from 'lib/entities/EntityInterface';

export const foreignKeyGetter: ForeignKeyGetterType = async (token?: CancelToken): Promise<any> => {

    const response: HuntGroupsRelUserPropertyList<Array<string | number>> = {};
    const promises: Array<Promise<unknown>> = [];

    promises[promises.length] = CountrySelectOptions(
        (options: any) => {
            response.numberCountry = options;
        },
        token
    );

    promises[promises.length] = UserSelectOptions(
        (options: any) => {
            response.user = options;
        },
        token
    );

    await Promise.all(promises);

    return response;
};