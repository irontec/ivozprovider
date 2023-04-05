import { DropdownChoices } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import store from 'store';

const RoutingTagSelectOptions: SelectOptionsType = ({
  callback,
  cancelToken,
}): Promise<unknown> => {
  const entities = store.getState().entities.entities;
  const RoutingTag = entities.RoutingTag;

  return defaultEntityBehavior.fetchFks(
    RoutingTag.path + '?_order[name]=ASC',
    ['id', 'name', 'tag'],
    (data: any) => {
      const options: DropdownChoices = [];
      for (const item of data) {
        options.push({ id: item.id, label: `${item.name} (${item.tag})` });
      }
      callback(options);
    },
    cancelToken
  );
};

export default RoutingTagSelectOptions;
