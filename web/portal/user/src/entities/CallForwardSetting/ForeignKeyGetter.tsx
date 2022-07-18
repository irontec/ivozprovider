import { ForeignKeyGetterType } from '@irontec/ivoz-ui/entities/EntityInterface';
import { autoSelectOptions } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { CallForwardSettingPropertyList } from './CallForwardSettingProperties';
import entities from '../index';
import VoicemailSelectOptions from 'entities/Voicemail/SelectOptions';

export const foreignKeyGetter: ForeignKeyGetterType = async ({
  cancelToken,
  entityService,
  match,
}): Promise<any> => {
  const response: CallForwardSettingPropertyList<unknown> = {};

  const promises = autoSelectOptions({
    entities,
    entityService,
    cancelToken,
    response,
    skip: [],
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
