import LocutionSelectOptions from 'entities/Locution/SelectOptions';
import CountrySelectOptions from 'entities/Country/SelectOptions';
import ExtensionSelectOptions from 'entities/Extension/SelectOptions';
import UserSelectOptions from 'entities/User/SelectOptions';
import { QueuePropertyList } from './QueueProperties';
import { ForeignKeyGetterType } from 'lib/entities/EntityInterface';

export const foreignKeyGetter: ForeignKeyGetterType = async ({cancelToken}): Promise<any> => {

    const response: QueuePropertyList<Array<string | number>> = {};
    const promises: Array<Promise<unknown>> = [];

    promises[promises.length] = LocutionSelectOptions({
        callback: (options: any) => {
            response.timeoutLocution = options;
            response.fullLocution = options;
            response.periodicAnnounceLocution = options;
        },
        cancelToken
    });

    promises[promises.length] = CountrySelectOptions({
        callback: (options: any) => {
            response.timeoutNumberCountry = options;
            response.fullNumberCountry = options;
        },
        cancelToken
    });

    promises[promises.length] = ExtensionSelectOptions({
        callback: (options: any) => {
            response.timeoutExtension = options;
            response.fullExtension = options;
        },
        cancelToken
    });

    promises[promises.length] = UserSelectOptions({
        callback: (options: any) => {
            response.timeoutVoiceMailUser = options;
            response.fullVoiceMailUser = options;
        },
        cancelToken
    });

    await Promise.all(promises);

    return response;
};