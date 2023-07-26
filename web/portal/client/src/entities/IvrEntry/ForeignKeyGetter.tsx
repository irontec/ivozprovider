import { autoSelectOptions } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { ForeignKeyGetterType } from '@irontec/ivoz-ui/entities/EntityInterface';

import EnabledVoicemailSelectOptions from '../Voicemail/EnabledVoicemailSelectOptions';
import { IvrEntryPropertyList } from './IvrEntryProperties';

export const foreignKeyGetter: ForeignKeyGetterType = async ({
  cancelToken,
  entityService,
}): Promise<unknown> => {
  const response: IvrEntryPropertyList<Array<string | number>> = {};

  const promises = autoSelectOptions({
    entityService,
    cancelToken,
    response,
    skip: ['voicemail'],
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
