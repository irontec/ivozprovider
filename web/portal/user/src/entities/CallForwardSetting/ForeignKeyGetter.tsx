import { autoSelectOptions } from '@irontec-voip/ivoz-ui/entities/DefaultEntityBehavior';
import { ForeignKeyGetterType } from '@irontec-voip/ivoz-ui/entities/EntityInterface';

import VoicemailSelectOptions from '../Voicemail/SelectOptions';
import { CallForwardSettingPropertyList } from './CallForwardSettingProperties';

export const foreignKeyGetter: ForeignKeyGetterType = async ({
  cancelToken,
  entityService,
  match,
}): Promise<unknown> => {
  const response: CallForwardSettingPropertyList<unknown> = {};

  const promises = autoSelectOptions({
    entityService,
    cancelToken,
    response,
    skip: ['voicemail'],
  });

  const voiceMailId = Object.values(match.params).shift() as string;
  promises.push(
    VoicemailSelectOptions(
      {
        callback: (options) => {
          response.voicemail = options;
        },
        cancelToken,
      },
      {
        voiceMailId,
      }
    )
  );

  await Promise.all(promises);

  return response;
};
