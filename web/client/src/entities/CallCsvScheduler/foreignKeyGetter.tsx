import DdiSelectOptions from 'entities/Ddi/SelectOptions';
import RetailAccountSelectOptions from 'entities/RetailAccount/SelectOptions';
import ResidentialDeviceSelectOptions from 'entities/ResidentialDevice/SelectOptions';
import UserSelectOptions from 'entities/User/SelectOptions';
import FaxSelectOptions from 'entities/Fax/SelectOptions';
import FriendSelectOptions from 'entities/Friend/SelectOptions';
import { CallCsvSchedulerPropertyList } from './CallCsvSchedulerProperties';
import { ForeignKeyGetterType } from 'lib/entities/EntityInterface';
import { CancelToken } from 'axios';

export const foreignKeyGetter: ForeignKeyGetterType = async (cancelToken?: CancelToken): Promise<any> => {

    const response: CallCsvSchedulerPropertyList<unknown> = {};
    const promises: Array<Promise<unknown>> = [];

    promises[promises.length] = DdiSelectOptions({
        callback: (options: any) => {
            response.ddi = options;
        },
        cancelToken
    });

    promises[promises.length] = RetailAccountSelectOptions({
        callback: (options: any) => {
            response.retailAccount = options;
        },
        cancelToken
    });

    promises[promises.length] = ResidentialDeviceSelectOptions({
        callback: (options: any) => {
            response.residentialDevice = options;
        },
        cancelToken
    });

    promises[promises.length] = UserSelectOptions({
        callback: (options: any) => {
            response.user = options;
        },
        cancelToken
    });

    promises[promises.length] = FaxSelectOptions({
        callback: (options: any) => {
            response.fax = options;
        },
        cancelToken
    });

    promises[promises.length] = FriendSelectOptions({
        callback: (options: any) => {
            response.friend = options;
        },
        cancelToken
    });

    await Promise.all(promises);

    return response;
};