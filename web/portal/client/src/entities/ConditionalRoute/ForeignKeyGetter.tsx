import { autoSelectOptions } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { ForeignKeyGetterType } from '@irontec/ivoz-ui/entities/EntityInterface';

import EnabledVoicemailSelectOptions from '../Voicemail/EnabledVoicemailSelectOptions';
import { ConditionalRoutePropertyList } from './ConditionalRouteProperties';

export const foreignKeyGetter: ForeignKeyGetterType = async ({
  cancelToken,
  entityService,
}): Promise<unknown> => {
  const response: ConditionalRoutePropertyList<unknown> = {};

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
