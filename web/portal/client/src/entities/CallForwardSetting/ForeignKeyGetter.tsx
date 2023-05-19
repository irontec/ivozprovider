import { autoSelectOptions } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { ForeignKeyGetterType } from '@irontec/ivoz-ui/entities/EntityInterface';

import EnabledVoicemailSelectOptions from '../Voicemail/EnabledVoicemailSelectOptions';
import { CallForwardSettingPropertyList } from './CallForwardSettingProperties';

export const foreignKeyGetter: ForeignKeyGetterType = async ({
  cancelToken,
  entityService,
  skip,
}): Promise<unknown> => {
  const response: CallForwardSettingPropertyList<unknown> = {};

  const skipEntities = [...(skip || []), 'skipEntities'];

  const promises = autoSelectOptions({
    entityService,
    cancelToken,
    response,
    skip: skipEntities,
  });

  if (!skipEntities.includes('voicemail')) {
    promises[promises.length] = EnabledVoicemailSelectOptions({
      callback: (options) => {
        response.voicemail = options;
      },
      cancelToken,
    });
  }

  await Promise.all(promises);

  return response;
};
