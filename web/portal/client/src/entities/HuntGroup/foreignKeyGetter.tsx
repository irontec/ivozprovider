import { autoSelectOptions } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { ForeignKeyGetterType } from '@irontec/ivoz-ui/entities/EntityInterface';
import EnabledVoicemailSelectOptions from 'entities/Voicemail/EnabledVoicemailSelectOptions';
import { HuntGroupPropertyList } from './HuntGroupProperties';

export const foreignKeyGetter: ForeignKeyGetterType = async ({
  cancelToken,
  entityService,
}): Promise<any> => {
  const response: HuntGroupPropertyList<Array<string | number>> = {};

  const promises = autoSelectOptions({
    entityService,
    cancelToken,
    response,
    skip: ['noAnswerVoicemail'],
  });

  promises[promises.length] = EnabledVoicemailSelectOptions({
    callback: (options: any) => {
      response.noAnswerVoicemail = options;
    },
    cancelToken,
  });

  await Promise.all(promises);

  return response;
};
