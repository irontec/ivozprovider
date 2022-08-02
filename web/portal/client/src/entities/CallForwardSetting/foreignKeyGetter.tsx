import { autoSelectOptions } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { ForeignKeyGetterType } from '@irontec/ivoz-ui/entities/EntityInterface';
import EnabledVoicemailSelectOptions from 'entities/Voicemail/EnabledVoicemailSelectOptions';
import store from 'store';
import { CallForwardSettingPropertyList } from './CallForwardSettingProperties';

export const foreignKeyGetter: ForeignKeyGetterType = async ({
  cancelToken,
  entityService,
  skip,
}): Promise<any> => {
  const response: CallForwardSettingPropertyList<unknown> = {};

  skip = skip || [];
  const skipEntities = [...skip, 'skipEntities'];

  const entities = store.getState().entities.entities;
  const promises = autoSelectOptions({
    entities,
    entityService,
    cancelToken,
    response,
    skip: skipEntities,
  });

  if (!skip.includes('voicemail')) {
    promises[promises.length] = EnabledVoicemailSelectOptions({
      callback: (options: any) => {
        response.voicemail = options;
      },
      cancelToken,
    });
  }

  await Promise.all(promises);

  return response;
};
