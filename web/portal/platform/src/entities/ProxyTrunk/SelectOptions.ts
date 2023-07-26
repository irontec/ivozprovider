import { DropdownChoices } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import store from 'store';

import { ProxyTrunkPropertiesList } from './ProxyTrunkProperties';

const ProxyTrunkSelectOptions: SelectOptionsType = ({
  callback,
  cancelToken,
}): Promise<unknown> => {
  const entities = store.getState().entities.entities;
  const ProxyTrunk = entities.ProxyTrunk;

  return defaultEntityBehavior.fetchFks(
    `${ProxyTrunk.path}?_order[name]=ASC`,
    ['id', 'ip', 'name'],
    (data: ProxyTrunkPropertiesList) => {
      const options: DropdownChoices = [];
      for (const item of data) {
        options.push({
          id: item.id as number,
          label: `${item.name} (${item.ip})`,
        });
      }

      callback(options);
    },
    cancelToken
  );
};

export default ProxyTrunkSelectOptions;
