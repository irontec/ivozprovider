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

export const foreignKeyGetter: ForeignKeyGetterType = async (token?: CancelToken): Promise<any> => {

    const response: DdiPropertyList<unknown> = {};
    const promises: Array<Promise<unknown>> = [];

    promises[promises.length] = ExternalCallFilterSelectOptions(
        (options: any) => {
            response.externalCallFilter = options;
        },
        token
    );

    promises[promises.length] = UserSelectOptions(
        (options: any) => {
            response.user = options;
        },
        token
    );

    promises[promises.length] = IvrSelectOptions(
        (options: any) => {
            response.ivr = options;
        },
        token
    );

    promises[promises.length] = HuntGroupSelectOptions(
        (options: any) => {
            response.huntGroup = options;
        },
        token
    );

    promises[promises.length] = FaxSelectOptions(
        (options: any) => {
            response.fax = options;
        },
        token
    );

    promises[promises.length] = ConferenceRoomSelectOptions(
        (options: any) => {
            response.conferenceRoom = options;
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
            response.country = options;
        },
        token
    );

    promises[promises.length] = LanguageSelectOptions(
        (options: any) => {
            response.language = options;
        },
        token
    );

    promises[promises.length] = QueueSelectOptions(
        (options: any) => {
            response.queue = options;
        },
        token
    );

    promises[promises.length] = ConditionalRouteSelectOptions(
        (options: any) => {
            response.conditionalRoute = options;
        },
        token
    );

    promises[promises.length] = RetailAccountSelectOptions(
        (options: any) => {
            response.retailAccount = options;
        },
        token
    );

    await Promise.all(promises);

    return response;
};