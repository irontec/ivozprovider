import { autoSelectOptions } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { ForeignKeyGetterType } from '@irontec/ivoz-ui/entities/EntityInterface';
import ScheduleSelectOptions from 'entities/Schedule/SelectOptions';
import EnabledVoicemailSelectOptions from 'entities/Voicemail/EnabledVoicemailSelectOptions';
import store from 'store';
import { CalendarPeriodPropertyList } from './CalendarPeriodProperties';

export const foreignKeyGetter: ForeignKeyGetterType = async ({
  cancelToken,
  entityService,
}): Promise<any> => {
  const response: CalendarPeriodPropertyList<unknown> = {};

  const entities = store.getState().entities.entities;

  const promises = autoSelectOptions({
    entities,
    entityService,
    cancelToken,
    response,
    skip: ['scheduleIds', 'voicemail'],
  });

  promises[promises.length] = ScheduleSelectOptions({
    callback: (options: any) => {
      response.scheduleIds = options;
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
