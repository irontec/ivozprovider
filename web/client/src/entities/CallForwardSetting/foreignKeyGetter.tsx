import UserSelectOptions from 'entities/User/SelectOptions';
import CountrySelectOptions from 'entities/Country/SelectOptions';
import ExtensionSelectOptions from 'entities/Extension/SelectOptions';
import { CallForwardSettingPropertyList } from './CallForwardSettingProperties';
import { CancelToken } from 'axios';
import { ForeignKeyGetterType } from 'lib/entities/EntityInterface';
import DdiSelectOptions from 'entities/Ddi/SelectOptions';
import ResidentialDeviceSelectOptions from 'entities/ResidentialDevice/SelectOptions';
import RetailAccountSelectOptions from 'entities/RetailAccount/SelectOptions';

export const foreignKeyGetter: ForeignKeyGetterType = async (token?: CancelToken): Promise<any> => {

    const response: CallForwardSettingPropertyList<unknown> = {};
    const promises: Array<Promise<unknown>> = [];

    promises[promises.length] = UserSelectOptions(
        (options: any) => {
            response.user = options;
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

    promises[promises.length] = DdiSelectOptions(
        (options: any) => {
            response.ddi = options;
        },
        token
    );

    promises[promises.length] = ResidentialDeviceSelectOptions(
        (options: any) => {
            response.residentialDevice = options;
        },
        token
    );

    promises[promises.length] = CountrySelectOptions(
        (options: any) => {
            response.numberCountry = options;
        },
        token
    );

    promises[promises.length] = RetailAccountSelectOptions(
        (options: any) => {
            //response.retailAccount = options;
            response.cfwToretailAccount = options;
        },
        token
    );

    await Promise.all(promises);

    return response;
};