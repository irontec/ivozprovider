import { autoSelectOptions } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { ForeignKeyGetterType } from '@irontec/ivoz-ui/entities/EntityInterface';
import CalendarSelectOptions from 'entities/Calendar/SelectOptions';
import MatchListSelectOptions from 'entities/MatchList/SelectOptions';
import RouteLockSelectOptions from 'entities/RouteLock/SelectOptions';
import ScheduleSelectOptions from 'entities/Schedule/SelectOptions';
import EnabledVoicemailSelectOptions from 'entities/Voicemail/EnabledVoicemailSelectOptions';
import { ConditionalRoutesConditionPropertyList } from './ConditionalRoutesConditionProperties';

export const foreignKeyGetter: ForeignKeyGetterType = async ({
  cancelToken,
  entityService,
}): Promise<any> => {
  const response: ConditionalRoutesConditionPropertyList<unknown> = {};

  const promises = autoSelectOptions({
    entityService,
    cancelToken,
    response,
    skip: [
      'matchListIds',
      'scheduleIds',
      'calendarIds',
      'routeLockIds',
      'voicemail',
    ],
  });

  promises[promises.length] = MatchListSelectOptions({
    callback: (options: any) => {
      response.matchListIds = options;
    },
    cancelToken,
  });

  promises[promises.length] = ScheduleSelectOptions({
    callback: (options: any) => {
      response.scheduleIds = options;
    },
    cancelToken,
  });

  promises[promises.length] = CalendarSelectOptions({
    callback: (options: any) => {
      response.calendarIds = options;
    },
    cancelToken,
  });

  promises[promises.length] = RouteLockSelectOptions({
    callback: (options: any) => {
      response.routeLockIds = options;
    },
    cancelToken,
  });

  promises[promises.length] = EnabledVoicemailSelectOptions({
    callback: (options: any) => {
      response.voicemail = options;
    },
    cancelToken,
  });

  await Promise.all(promises);

  return response;
};
