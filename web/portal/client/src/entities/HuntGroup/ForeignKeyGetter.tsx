import { autoSelectOptions } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { ForeignKeyGetterType } from '@irontec/ivoz-ui/entities/EntityInterface';

import EnabledVoicemailSelectOptions from '../Voicemail/EnabledVoicemailSelectOptions';
import { HuntGroupPropertyList } from './HuntGroupProperties';

export const foreignKeyGetter: ForeignKeyGetterType = async ({
  cancelToken,
  entityService,
}): Promise<unknown> => {
  const response: HuntGroupPropertyList<Array<string | number>> = {};

  const promises = autoSelectOptions({
    entityService,
    cancelToken,
    response,
    skip: ['noAnswerVoicemail'],
  });

  promises[promises.length] = EnabledVoicemailSelectOptions({
    callback: (options) => {
      response.noAnswerVoicemail = options;
    },
    cancelToken,
  });

  await Promise.all(promises);

  return response;
};
