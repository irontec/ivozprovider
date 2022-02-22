import LocutionSelectOptions from 'entities/Locution/SelectOptions';
import IvrSelectOptions from 'entities/Ivr/SelectOptions';
import HuntGroupSelectOptions from 'entities/HuntGroup/SelectOptions';
import UserSelectOptions from 'entities/User/SelectOptions';
import CountrySelectOptions from 'entities/Country/SelectOptions';
import QueueSelectOptions from 'entities/Queue/SelectOptions';
import ConferenceRoomSelectOptions from 'entities/ConferenceRoom/SelectOptions';
import ExtensionSelectOptions from 'entities/Extension/SelectOptions';
import { ConditionalRoutePropertyList } from './ConditionalRouteProperties';
import { CancelToken } from 'axios';
import { ForeignKeyGetterType } from 'lib/entities/EntityInterface';

export const foreignKeyGetter: ForeignKeyGetterType = async (cancelToken?: CancelToken): Promise<any> => {

    const response: ConditionalRoutePropertyList<unknown> = {};
    const promises: Array<Promise<unknown>> = [];

    promises[promises.length] = LocutionSelectOptions({
        callback: (options: any) => {
            response.locution = options;
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

    promises[promises.length] = UserSelectOptions({
        callback: (options: any) => {
            response.voicemailUser = options;
            response.user = options;
        },
        cancelToken
    });

    promises[promises.length] = CountrySelectOptions({
        callback: (options: any) => {
            response.numberCountry = options;
        },
        cancelToken
    });

    promises[promises.length] = QueueSelectOptions({
        callback: (options: any) => {
            response.queue = options;
        },
        cancelToken
    });

    promises[promises.length] = ConferenceRoomSelectOptions({
        callback: (options: any) => {
            response.conferenceRoom = options;
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