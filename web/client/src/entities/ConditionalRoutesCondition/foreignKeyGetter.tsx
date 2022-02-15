import LocutionSelectOptions from 'entities/Locution/SelectOptions';
import IvrSelectOptions from 'entities/Ivr/SelectOptions';
import HuntGroupSelectOptions from 'entities/HuntGroup/SelectOptions';
import UserSelectOptions from 'entities/User/SelectOptions';
import CountrySelectOptions from 'entities/Country/SelectOptions';
import QueueSelectOptions from 'entities/Queue/SelectOptions';
import ConferenceRoomSelectOptions from 'entities/ConferenceRoom/SelectOptions';
import ExtensionSelectOptions from 'entities/Extension/SelectOptions';
import { ConditionalRoutesConditionPropertyList } from './ConditionalRoutesConditionProperties';
import { CancelToken } from 'axios';
import { ForeignKeyGetterType } from 'lib/entities/EntityInterface';
import MatchListSelectOptions from 'entities/MatchList/SelectOptions';
import ScheduleSelectOptions from 'entities/Schedule/SelectOptions';
import CalendarSelectOptions from 'entities/Calendar/SelectOptions';
import FriendSelectOptions from 'entities/Friend/SelectOptions';
import RouteLockSelectOptions from 'entities/RouteLock/SelectOptions';

export const foreignKeyGetter: ForeignKeyGetterType = async (token?: CancelToken): Promise<any> => {

    const response: ConditionalRoutesConditionPropertyList<unknown> = {};
    const promises: Array<Promise<unknown>> = [];

    promises[promises.length] = MatchListSelectOptions(
        (options: any) => {
            response.matchListIds = options;
        },
        token
    );

    promises[promises.length] = ScheduleSelectOptions(
        (options: any) => {
            response.scheduleIds = options;
        },
        token
    );

    promises[promises.length] = CalendarSelectOptions(
        (options: any) => {
            response.calendarIds = options;
        },
        token
    );

    promises[promises.length] = RouteLockSelectOptions(
        (options: any) => {
            response.routeLockIds = options;
        },
        token
    );

    promises[promises.length] = LocutionSelectOptions(
        (options: any) => {
            response.locution = options;
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

    promises[promises.length] = UserSelectOptions(
        (options: any) => {
            response.voicemailUser = options;
            response.user = options;
        },
        token
    );

    promises[promises.length] = CountrySelectOptions(
        (options: any) => {
            response.numberCountry = options;
        },
        token
    );

    promises[promises.length] = FriendSelectOptions(
        (options: any) => {
            response.friendValue = options;
        },
        token
    );

    promises[promises.length] = QueueSelectOptions(
        (options: any) => {
            response.queue = options;
        },
        token
    );

    promises[promises.length] = ConferenceRoomSelectOptions(
        (options: any) => {
            response.conferenceRoom = options;
        },
        token
    );

    promises[promises.length] = ExtensionSelectOptions(
        (options: any) => {
            response.extension = options;
        },
        token
    );

    await Promise.all(promises);

    return response;
};