import { autoSelectOptions } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { ForeignKeyGetterType } from '@irontec/ivoz-ui/entities/EntityInterface';

import CalendarSelectOptions from '../Calendar/SelectOptions';
import MatchListSelectOptions from '../MatchList/SelectOptions';
import RouteLockSelectOptions from '../RouteLock/SelectOptions';
import ScheduleSelectOptions from '../Schedule/SelectOptions';
import EnabledVoicemailSelectOptions from '../Voicemail/EnabledVoicemailSelectOptions';
import { ConditionalRoutesConditionPropertyList } from './ConditionalRoutesConditionProperties';

export const foreignKeyGetter: ForeignKeyGetterType = async ({
  cancelToken,
  entityService,
}): Promise<unknown> => {
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
    callback: (options) => {
      response.matchListIds = options;
    },
    cancelToken,
  });

  promises[promises.length] = ScheduleSelectOptions({
    callback: (options) => {
      response.scheduleIds = options;
    },
    cancelToken,
  });

  promises[promises.length] = CalendarSelectOptions({
    callback: (options) => {
      response.calendarIds = options;
    },
    cancelToken,
  });

  promises[promises.length] = RouteLockSelectOptions({
    callback: (options) => {
      response.routeLockIds = options;
    },
    cancelToken,
  });

  promises[promises.length] = EnabledVoicemailSelectOptions({
    callback: (options) => {
      response.voicemail = options;
    },
    cancelToken,
  });

  await Promise.all(promises);

  return response;
};
