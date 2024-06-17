import { autoSelectOptions } from '@irontec-voip/ivoz-ui/entities/DefaultEntityBehavior';
import { ForeignKeyGetterType } from '@irontec-voip/ivoz-ui/entities/EntityInterface';

// import EnabledVoicemailSelectOptions from '../Voicemail/EnabledVoicemailSelectOptions';
import { VoicemailPropertyList } from './VoicemailProperties';

export const foreignKeyGetter: ForeignKeyGetterType = async ({
  cancelToken,
  entityService,
}): Promise<unknown> => {
  const response: VoicemailPropertyList<Array<string | number>> = {};

  const promises = autoSelectOptions({
    entityService,
    cancelToken,
    response,
  });

  await Promise.all(promises);

  return response;
};
