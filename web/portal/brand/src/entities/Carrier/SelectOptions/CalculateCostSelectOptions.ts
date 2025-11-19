import { DropdownChoices } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import store from 'store';

import { CarrierProperties } from '../CarrierProperties';

const CalculateCostSelectOptions: SelectOptionsType = ({
  callback,
  cancelToken,
}): Promise<unknown> => {
  const entities = store.getState().entities.entities;
  const Carrier = entities.Carrier;

  return defaultEntityBehavior.fetchFks(
    `${Carrier.path}?_order[name]=ASC&calculateCost=1`,
    ['id', 'name', 'hasServers'],
    (data) => {
      const carriersWithServers = data.filter(
        (carrier: CarrierProperties) => carrier.hasServers
      );

      const options: DropdownChoices = [];
      for (const item of carriersWithServers) {
        options.push({ id: item.id, label: item.name });
      }

      callback(options);
    },
    cancelToken
  );
};

export default CalculateCostSelectOptions;
