import CountrySelectOptions from 'entities/Country/SelectOptions';
import IvrSelectOptions from 'entities/Ivr/SelectOptions';
import HuntGroupSelectOptions from 'entities/HuntGroup/SelectOptions';
import ConferenceRoomSelectOptions from 'entities/ConferenceRoom/SelectOptions';
import UserSelectOptions from 'entities/User/SelectOptions';
import QueueSelectOptions from 'entities/Queue/SelectOptions';
import ConditionalRouteSelectOptions from 'entities/ConditionalRoute/SelectOptions';
import { ExtensionPropertyList } from './ExtensionProperties';
import { CancelToken } from 'axios';
import { ForeignKeyGetterType } from 'lib/entities/EntityInterface';

export const foreignKeyGetter: ForeignKeyGetterType = async (cancelToken?: CancelToken): Promise<any> => {

    const response: ExtensionPropertyList<Array<string | number>> = {};
    const promises: Array<Promise<unknown>> = [];

    promises[promises.length] = CountrySelectOptions({
        callback: (options: any) => {
            response.numberCountry = options;
        },
        cancelToken
    });

    promises[promises.length] = IvrSelectOptions({
        callback: (options: any) => {
            response.ivr = options;
        },
        cancelToken
    });

    promises[promises.length] = HuntGroupSelectOptions({
        callback: (options: any) => {
            response.huntGroup = options;
        },
        cancelToken
    });

    promises[promises.length] = ConferenceRoomSelectOptions({
        callback: (options: any) => {
            response.conferenceRoom = options;
        },
        cancelToken
    });

    promises[promises.length] = UserSelectOptions({
        callback: (options: any) => {
            response.user = options;
        },
        cancelToken
    });

    promises[promises.length] = QueueSelectOptions({
        callback: (options: any) => {
            response.queue = options;
        },
        cancelToken
    });

    promises[promises.length] = ConditionalRouteSelectOptions({
        callback: (options: any) => {
            response.conditionalRoute = options;
        },
        cancelToken
    });

    await Promise.all(promises);

    return response;
};