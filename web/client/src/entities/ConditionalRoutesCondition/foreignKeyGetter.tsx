import { ConditionalRoutesConditionPropertyList } from './ConditionalRoutesConditionProperties';
import { ForeignKeyGetterType } from 'lib/entities/EntityInterface';
import MatchListSelectOptions from 'entities/MatchList/SelectOptions';
import ScheduleSelectOptions from 'entities/Schedule/SelectOptions';
import CalendarSelectOptions from 'entities/Calendar/SelectOptions';
import RouteLockSelectOptions from 'entities/RouteLock/SelectOptions';
import { autoSelectOptions } from 'lib/entities/DefaultEntityBehavior';
import entities from '../index';
import FeaturesRelCompanySelectOptions from 'entities/FeaturesRelCompany/SelectOptions';
import VoicemailSelectOptions from 'entities/Voicemail/SelectOptions';

export const foreignKeyGetter: ForeignKeyGetterType = async ({ cancelToken, entityService }): Promise<any> => {

    const response: ConditionalRoutesConditionPropertyList<unknown> = {};

    const promises = autoSelectOptions({
        entities,
        entityService,
        cancelToken,
        response,
        skip: [
            'matchListIds',
            'scheduleIds',
            'calendarIds',
            'routeLockIds',
            'voicemail',
        ]
    });

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

    promises[promises.length] = VoicemailSelectOptions({
        callback: (options: any) => {
            response.voicemail = options;
        },
        cancelToken
    });

    promises[promises.length] = FeaturesRelCompanySelectOptions(
        {
            callback: (options: any) => {
                response.companyFeatures = options;
            },
            cancelToken
        }
    );

    await Promise.all(promises);

    return response;
};