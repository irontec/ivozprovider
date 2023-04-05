import { autoSelectOptions } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { ForeignKeyGetterType } from '@irontec/ivoz-ui/entities/EntityInterface';
import CalendarSelectOptions from 'entities/Calendar/SelectOptions';
import MatchListSelectOptions from 'entities/MatchList/SelectOptions';
import ScheduleSelectOptions from 'entities/Schedule/SelectOptions';
import EnabledVoicemailSelectOptions from 'entities/Voicemail/EnabledVoicemailSelectOptions';
import { ExternalCallFilterPropertyList } from './ExternalCallFilterProperties';

export const foreignKeyGetter: ForeignKeyGetterType = async ({
  cancelToken,
  entityService,
}): Promise<any> => {
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
    callback: (options: any) => {
      response.holidayVoicemail = options;
      response.outOfScheduleVoicemail = options;
    },
    cancelToken,
  });

  promises[promises.length] = MatchListSelectOptions({
    callback: (options: any) => {
      response.whiteListIds = options;
      response.blackListIds = options;
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

  await Promise.all(promises);

  return response;
};
