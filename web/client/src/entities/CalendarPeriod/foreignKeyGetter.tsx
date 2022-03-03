import { CalendarPeriodPropertyList } from './CalendarPeriodProperties';
import { ForeignKeyGetterType } from 'lib/entities/EntityInterface';
import ScheduleSelectOptions from 'entities/Schedule/SelectOptions';
import { autoSelectOptions } from 'lib/entities/DefaultEntityBehavior';
import entities from '../index';
import { VoicemailEnabledSelectOptions } from 'entities/User/SelectOptions';

export const foreignKeyGetter: ForeignKeyGetterType = async ({ cancelToken, entityService }): Promise<any> => {

    const response: CalendarPeriodPropertyList<unknown> = {};

    const promises = autoSelectOptions({
        entities,
        entityService,
        cancelToken,
        response,
        skip: [
            'scheduleIds',
            'voiceMailUser',
        ]
    });

    promises[promises.length] = ScheduleSelectOptions({
        callback: (options: any) => {
            response.scheduleIds = options;
        },
        cancelToken
    });

    promises[promises.length] = VoicemailEnabledSelectOptions({
        callback: (options: any) => {
            response.voiceMailUser = options;
        },
        cancelToken
    });

    await Promise.all(promises);

    return response;
};