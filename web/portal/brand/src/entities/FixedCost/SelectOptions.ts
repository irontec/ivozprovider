import { DropdownChoices } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import store from 'store';

const FixedCostSelectOptions: SelectOptionsType = ({
  callback,
  cancelToken,
}): Promise<unknown> => {
  const entities = store.getState().entities.entities;
  const FixedCost = entities.FixedCost;

  return defaultEntityBehavior.fetchFks(
    `${FixedCost.path}?_order[name]=ASC`,
    ['id', 'name'],
    (data) => {
      const options: DropdownChoices = [];
      for (const item of data) {
        options.push({ id: item.id, label: item.name });
      }

      callback(options);
    },
    cancelToken
  );
};

export default FixedCostSelectOptions;
