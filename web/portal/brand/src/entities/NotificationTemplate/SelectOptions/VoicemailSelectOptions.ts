import { DropdownChoices, fetchAllPages } from '@irontec/ivoz-ui';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import store from 'store';

const VoicemailSelectOptions: SelectOptionsType = ({
  callback,
  cancelToken,
}): Promise<unknown> => {
  const entities = store.getState().entities.entities;
  const NotificationTemplate = entities.NotificationTemplate;

  return fetchAllPages({
    endpoint: `${NotificationTemplate.path}?type=voicemail`,
    params: {
      _properties: ['id', 'name'],
    },
    setter: async (data) => {
      const options: DropdownChoices = {};
      for (const item of data) {
        options[item.id] = NotificationTemplate.toStr(item);
      }

      callback(options);
    },
    cancelToken,
  });
};

export default VoicemailSelectOptions;
