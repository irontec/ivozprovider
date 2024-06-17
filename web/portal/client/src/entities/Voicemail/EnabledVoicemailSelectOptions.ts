import { DropdownChoices } from '@irontec-voip/ivoz-ui';
import { SelectOptionsType } from '@irontec-voip/ivoz-ui/entities/EntityInterface';
import { fetchAllPages } from '@irontec-voip/ivoz-ui/helpers/fechAllPages';
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

  return fetchAllPages({
    endpoint: Voicemail.path,
    params,
    setter: async (data) => {
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
