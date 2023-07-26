import { autoSelectOptions } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { ForeignKeyGetterType } from '@irontec/ivoz-ui/entities/EntityInterface';

import EnabledVoicemailSelectOptions from '../Voicemail/EnabledVoicemailSelectOptions';
import { QueuePropertyList } from './QueueProperties';

export const foreignKeyGetter: ForeignKeyGetterType = async ({
  cancelToken,
  entityService,
}): Promise<unknown> => {
  const response: QueuePropertyList<Array<string | number>> = {};

  const promises = autoSelectOptions({
    entityService,
    cancelToken,
    response,
    skip: ['timeoutVoicemail', 'fullVoicemail'],
  });

  promises[promises.length] = EnabledVoicemailSelectOptions({
    callback: (options) => {
      response.timeoutVoicemail = options;
      response.fullVoicemail = options;
    },
    cancelToken,
  });

  await Promise.all(promises);

  return response;
};
