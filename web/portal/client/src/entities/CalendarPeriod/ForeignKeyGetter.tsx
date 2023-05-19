import { autoSelectOptions } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { ForeignKeyGetterType } from '@irontec/ivoz-ui/entities/EntityInterface';

import ScheduleSelectOptions from '../Schedule/SelectOptions';
import EnabledVoicemailSelectOptions from '../Voicemail/EnabledVoicemailSelectOptions';
import { CalendarPeriodPropertyList } from './CalendarPeriodProperties';

export const foreignKeyGetter: ForeignKeyGetterType = async ({
  cancelToken,
  entityService,
}): Promise<unknown> => {
  const response: CalendarPeriodPropertyList<unknown> = {};

  const promises = autoSelectOptions({
    entityService,
    cancelToken,
    response,
    skip: ['scheduleIds', 'voicemail'],
  });

  promises[promises.length] = ScheduleSelectOptions({
    callback: (options) => {
      response.scheduleIds = options;
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
