import MatchListSelectOptions from 'entities/MatchList/SelectOptions';
import ScheduleSelectOptions from 'entities/Schedule/SelectOptions';
import CalendarSelectOptions from 'entities/Calendar/SelectOptions';
import { ExternalCallFilterPropertyList } from './ExternalCallFilterProperties';
import { ForeignKeyGetterType } from 'lib/entities/EntityInterface';
import entities from '../index';
import { autoSelectOptions } from 'lib/entities/DefaultEntityBehavior';
import VoicemailSelectOptions from 'entities/Voicemail/SelectOptions';

export const foreignKeyGetter: ForeignKeyGetterType = async ({ cancelToken, entityService }): Promise<any> => {

    const response: ExternalCallFilterPropertyList<Array<string | number>> = {};

    const promises = autoSelectOptions({
        entities,
        entityService,
        cancelToken,
        response,
        skip: [
            'holidayVoicemail',
            'outOfScheduleVoicemail',
            'whiteListIds',
            'blackListIds',
            'scheduleIds',
            'calendarIds',
        ],
    });

    promises[promises.length] = VoicemailSelectOptions({
        callback: (options: any) => {
            response.holidayVoicemail = options;
            response.outOfScheduleVoicemail = options;
        },
        cancelToken
    });

    promises[promises.length] = MatchListSelectOptions({
        callback: (options: any) => {
            response.whiteListIds = options;
            response.blackListIds = options;
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

    await Promise.all(promises);

    return response;
};