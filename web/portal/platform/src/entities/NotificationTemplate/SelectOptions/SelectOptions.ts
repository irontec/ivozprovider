import { DropdownChoices, EntityValues } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import store from 'store';

const SelectOptions: SelectOptionsType = ({
  callback,
  cancelToken,
}): Promise<unknown> => {
  const entities = store.getState().entities.entities;
  const NotificationTemplate = entities.NotificationTemplate;

  return defaultEntityBehavior.fetchFks(
    `${NotificationTemplate.path}?_order[name]=ASC`,
    ['id', 'name'],
    (data: Array<EntityValues>) => {
      const options: DropdownChoices = [];
      for (const item of data) {
        options.push({
          id: item.id as number,
          label: NotificationTemplate.toStr(item) as string,
        });
      }

      callback(options);
    },
    cancelToken
  );
};

export default SelectOptions;
