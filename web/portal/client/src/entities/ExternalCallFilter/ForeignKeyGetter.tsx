import { autoSelectOptions } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { ForeignKeyGetterType } from '@irontec/ivoz-ui/entities/EntityInterface';

import CalendarSelectOptions from '../Calendar/SelectOptions';
import MatchListSelectOptions from '../MatchList/SelectOptions';
import ScheduleSelectOptions from '../Schedule/SelectOptions';
import EnabledVoicemailSelectOptions from '../Voicemail/EnabledVoicemailSelectOptions';
import { ExternalCallFilterPropertyList } from './ExternalCallFilterProperties';

export const foreignKeyGetter: ForeignKeyGetterType = async ({
  cancelToken,
  entityService,
}): Promise<unknown> => {
  const response: ExternalCallFilterPropertyList<Array<string | number>> = {};

  const promises = autoSelectOptions({
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

  promises[promises.length] = EnabledVoicemailSelectOptions({
    callback: (options) => {
      response.holidayVoicemail = options;
      response.outOfScheduleVoicemail = options;
    },
    cancelToken,
  });

  promises[promises.length] = MatchListSelectOptions({
    callback: (options) => {
      response.whiteListIds = options;
      response.blackListIds = options;
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

  await Promise.all(promises);

  return response;
};
