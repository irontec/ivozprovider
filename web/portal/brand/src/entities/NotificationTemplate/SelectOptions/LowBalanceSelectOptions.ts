import { DropdownChoices } from '@irontec-voip/ivoz-ui';
import { SelectOptionsType } from '@irontec-voip/ivoz-ui/entities/EntityInterface';
import { fetchAllPages } from '@irontec-voip/ivoz-ui/helpers/fechAllPages';
import store from 'store';

const LowBalanceSelectOptions: SelectOptionsType = ({
  callback,
  cancelToken,
}): Promise<unknown> => {
  const entities = store.getState().entities.entities;
  const NotificationTemplate = entities.NotificationTemplate;

  return fetchAllPages({
    endpoint: `${NotificationTemplate.path}?type=lowbalance`,
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

export default LowBalanceSelectOptions;
