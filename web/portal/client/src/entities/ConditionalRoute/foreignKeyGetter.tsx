import { autoSelectOptions } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { ForeignKeyGetterType } from '@irontec/ivoz-ui/entities/EntityInterface';
import EnabledVoicemailSelectOptions from 'entities/Voicemail/EnabledVoicemailSelectOptions';
import store from 'store';
import { ConditionalRoutePropertyList } from './ConditionalRouteProperties';

export const foreignKeyGetter: ForeignKeyGetterType = async ({
  cancelToken,
  entityService,
}): Promise<any> => {
  const response: ConditionalRoutePropertyList<unknown> = {};

  const entities = store.getState().entities.entities;
  const promises = autoSelectOptions({
    entities,
    entityService,
    cancelToken,
    response,
    skip: ['voicemail'],
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
