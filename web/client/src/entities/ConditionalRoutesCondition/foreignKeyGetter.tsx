import LocutionSelectOptions from 'entities/Locution/SelectOptions';
import IvrSelectOptions from 'entities/Ivr/SelectOptions';
import HuntGroupSelectOptions from 'entities/HuntGroup/SelectOptions';
import UserSelectOptions from 'entities/User/SelectOptions';
import CountrySelectOptions from 'entities/Country/SelectOptions';
import QueueSelectOptions from 'entities/Queue/SelectOptions';
import ConferenceRoomSelectOptions from 'entities/ConferenceRoom/SelectOptions';
import ExtensionSelectOptions from 'entities/Extension/SelectOptions';
import { ConditionalRoutesConditionPropertyList } from './ConditionalRoutesConditionProperties';
import { ForeignKeyGetterType } from 'lib/entities/EntityInterface';
import MatchListSelectOptions from 'entities/MatchList/SelectOptions';
import ScheduleSelectOptions from 'entities/Schedule/SelectOptions';
import CalendarSelectOptions from 'entities/Calendar/SelectOptions';
import FriendSelectOptions from 'entities/Friend/SelectOptions';
import RouteLockSelectOptions from 'entities/RouteLock/SelectOptions';

export const foreignKeyGetter: ForeignKeyGetterType = async ({cancelToken}): Promise<any> => {

    const response: ConditionalRoutesConditionPropertyList<unknown> = {};
    const promises: Array<Promise<unknown>> = [];

    promises[promises.length] = MatchListSelectOptions({
        callback: (options: any) => {
            response.matchListIds = options;
        },
        cancelToken
    });

    promises[promises.length] = ScheduleSelectOptions({
        callback: (options: any) => {
            response.scheduleIds = options;
        },
        cancelToken
    });

    promises[promises.length] = CalendarSelectOptions({
        callback: (options: any) => {
            response.calendarIds = options;
        },
        cancelToken
    });

    promises[promises.length] = RouteLockSelectOptions({
        callback: (options: any) => {
            response.routeLockIds = options;
        },
        cancelToken
    });

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

    promises[promises.length] = FriendSelectOptions({
        callback: (options: any) => {
            response.friendValue = options;
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