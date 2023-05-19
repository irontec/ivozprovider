import { DropdownChoices } from '@irontec/ivoz-ui';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import store from 'store';

import { VoicemailPropertiesList } from './VoicemailProperties';

const EnabledVoicemailSelectOptions: SelectOptionsType = ({
  callback,
  cancelToken,
}): Promise<unknown> => {
  const params = {
    _properties: ['id', 'name'],
    enabled: 1,
  };

  const entities = store.getState().entities.entities;
  const Voicemail = entities.Voicemail;

  const getAction = store.getActions().api.get;

  return getAction({
    path: Voicemail.path,
    params,
    successCallback: async (data) => {
      const options: DropdownChoices = {};
      for (const item of data as VoicemailPropertiesList) {
        options[item.id as number] = `${item.name}`;
      }
      callback(options);
    },
    cancelToken,
  });
};

export default EnabledVoicemailSelectOptions;
