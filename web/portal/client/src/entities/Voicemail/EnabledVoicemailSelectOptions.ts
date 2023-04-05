import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import store from 'store';

const EnabledVoicemailSelectOptions: SelectOptionsType = ({
  callback,
  cancelToken,
}): Promise<unknown> => {
  const params: any = {
    _properties: ['id', 'name'],
    enabled: 1,
  };

  const entities = store.getState().entities.entities;
  const Voicemail = entities.Voicemail;

  const getAction = store.getActions().api.get;
  return getAction({
    path: Voicemail.path,
    params,
    successCallback: async (data: any) => {
      const options: any = {};
      for (const item of data) {
        options[item.id] = `${item.name}`;
      }
      callback(options);
    },
    cancelToken,
  });
};

export default EnabledVoicemailSelectOptions;
