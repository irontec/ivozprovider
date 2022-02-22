import UserSelectOptions from 'entities/User/SelectOptions';
import CountrySelectOptions from 'entities/Country/SelectOptions';
import ExtensionSelectOptions from 'entities/Extension/SelectOptions';
import { CallForwardSettingPropertyList } from './CallForwardSettingProperties';
import { CancelToken } from 'axios';
import { ForeignKeyGetterType } from 'lib/entities/EntityInterface';
import DdiSelectOptions from 'entities/Ddi/SelectOptions';
import ResidentialDeviceSelectOptions from 'entities/ResidentialDevice/SelectOptions';
import RetailAccountSelectOptions from 'entities/RetailAccount/SelectOptions';

export const foreignKeyGetter: ForeignKeyGetterType = async (cancelToken?: CancelToken): Promise<any> => {

    const response: CallForwardSettingPropertyList<unknown> = {};
    const promises: Array<Promise<unknown>> = [];

    promises[promises.length] = UserSelectOptions({
        callback: (options: any) => {
            response.user = options;
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

    promises[promises.length] = DdiSelectOptions({
        callback: (options: any) => {
            response.ddi = options;
        },
        cancelToken
    });

    promises[promises.length] = ResidentialDeviceSelectOptions({
        callback: (options: any) => {
            response.residentialDevice = options;
        },
        cancelToken
    });

    promises[promises.length] = CountrySelectOptions({
        callback: (options: any) => {
            response.numberCountry = options;
        },
        cancelToken
    });

    promises[promises.length] = RetailAccountSelectOptions({
        callback: (options: any) => {
            //response.retailAccount = options;
            response.cfwToretailAccount = options;
        },
        cancelToken
    });

    await Promise.all(promises);

    return response;
};