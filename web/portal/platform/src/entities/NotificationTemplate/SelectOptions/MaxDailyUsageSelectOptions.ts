import { DropdownChoices, fetchAllPages } from '@irontec/ivoz-ui';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import store from 'store';

type NotificationTemplateSelectOptionsProps = {
  brandId?: number;
};

const MaxDailyUsageSelectOptions: SelectOptionsType<
  NotificationTemplateSelectOptionsProps
> = ({ callback, cancelToken }, customProps): Promise<unknown> => {
  const entities = store.getState().entities.entities;
  const NotificationTemplate = entities.NotificationTemplate;
  const brandId = customProps?.brandId;

  if (!brandId) {
    callback([]);

    return Promise.resolve();
  }

  return fetchAllPages({
    endpoint: `${NotificationTemplate.path}?type=maxDailyUsage&brand=${brandId}`,
    params: {
      _properties: ['id', 'name'],
    },
    setter: async (data) => {
      const options: DropdownChoices = [];
      for (const item of data) {
        options.push({
          id: item.id as number,
          label: NotificationTemplate.toStr(item),
        });
      }

      callback(options);
    },
    cancelToken,
  });
};

export default MaxDailyUsageSelectOptions;
