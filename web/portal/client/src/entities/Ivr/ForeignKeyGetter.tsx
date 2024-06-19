import { autoSelectOptions } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { ForeignKeyGetterType } from '@irontec/ivoz-ui/entities/EntityInterface';

import ExtensionSelectOptions from '../Extension/SelectOptions';
import EnabledVoicemailSelectOptions from '../Voicemail/EnabledVoicemailSelectOptions';
import { IvrPropertyList } from './IvrProperties';

export const foreignKeyGetter: ForeignKeyGetterType = async ({
  cancelToken,
  entityService,
}): Promise<unknown> => {
  const response: IvrPropertyList<Array<string | number>> = {};

  const promises = autoSelectOptions({
    entityService,
    cancelToken,
    response,
    skip: [
      'noInputExtension',
      'errorExtension',
      'excludedExtensionIds',

      'noInputVoicemail',
      'errorVoicemail',
    ],
  });

  promises[promises.length] = ExtensionSelectOptions({
    callback: (options) => {
      response.noInputExtension = options;
      response.errorExtension = options;
      response.excludedExtensionIds = options;
    },
    cancelToken,
  });

  promises[promises.length] = EnabledVoicemailSelectOptions({
    callback: (options) => {
      response.noInputVoicemail = options;
      response.errorVoicemail = options;
    },
    cancelToken,
  });

  await Promise.all(promises);

  return response;
};
