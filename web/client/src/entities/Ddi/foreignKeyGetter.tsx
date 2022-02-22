import ExternalCallFilterSelectOptions from 'entities/ExternalCallFilter/SelectOptions';
import UserSelectOptions from 'entities/User/SelectOptions';
import IvrSelectOptions from 'entities/Ivr/SelectOptions';
import HuntGroupSelectOptions from 'entities/HuntGroup/SelectOptions';
import FaxSelectOptions from 'entities/Fax/SelectOptions';
import ConferenceRoomSelectOptions from 'entities/ConferenceRoom/SelectOptions';
import ResidentialDeviceSelectOptions from 'entities/ResidentialDevice/SelectOptions';
import CountrySelectOptions from 'entities/Country/SelectOptions';
import LanguageSelectOptions from 'entities/Language/SelectOptions';
import QueueSelectOptions from 'entities/Queue/SelectOptions';
import ConditionalRouteSelectOptions from 'entities/ConditionalRoute/SelectOptions';
import RetailAccountSelectOptions from 'entities/RetailAccount/SelectOptions';
import { DdiPropertyList } from './DdiProperties';
import { CancelToken } from 'axios';
import { ForeignKeyGetterType } from 'lib/entities/EntityInterface';

export const foreignKeyGetter: ForeignKeyGetterType = async (cancelToken?: CancelToken): Promise<any> => {

    const response: DdiPropertyList<unknown> = {};
    const promises: Array<Promise<unknown>> = [];

    promises[promises.length] = ExternalCallFilterSelectOptions({
        callback: (options: any) => {
            response.externalCallFilter = options;
        },
        cancelToken
    });

    promises[promises.length] = UserSelectOptions({
        callback: (options: any) => {
            response.user = options;
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

    promises[promises.length] = FaxSelectOptions({
        callback: (options: any) => {
            response.fax = options;
        },
        cancelToken
    });

    promises[promises.length] = ConferenceRoomSelectOptions({
        callback: (options: any) => {
            response.conferenceRoom = options;
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
            response.country = options;
        },
        cancelToken
    });

    promises[promises.length] = LanguageSelectOptions({
        callback: (options: any) => {
            response.language = options;
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

    promises[promises.length] = RetailAccountSelectOptions({
        callback: (options: any) => {
            response.retailAccount = options;
        },
        cancelToken
    });

    await Promise.all(promises);

    return response;
};