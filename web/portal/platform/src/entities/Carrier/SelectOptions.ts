import { DropdownChoices } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import store from 'store';

const CarrierSelectOptions: SelectOptionsType = ({
  callback,
  cancelToken,
}): Promise<unknown> => {
  const entities = store.getState().entities.entities;
  const Carrier = entities.Carrier;

  return defaultEntityBehavior.fetchFks(
    `${Carrier.path}?_order[name]=ASC`,
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

export default CarrierSelectOptions;
