import { DropdownChoices } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import store from 'store';

const OutgoingRoutingSelectOptions: SelectOptionsType = ({
  callback,
  cancelToken,
}): Promise<unknown> => {
  const entities = store.getState().entities.entities;
  const OutgoingRouting = entities.OutgoingRouting;

  return defaultEntityBehavior.fetchFks(
    OutgoingRouting.path + '?_order[name]=ASC',
    ['id', 'name'],
    (data: any) => {
      const options: DropdownChoices = [];
      for (const item of data) {
        options.push({ id: item.id, label: item.name });
      }

      callback(options);
    },
    cancelToken
  );
};

export default OutgoingRoutingSelectOptions;
