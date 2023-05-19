import { DropdownChoices } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import store from 'store';

const ProxyTrunkSelectOptions: SelectOptionsType = ({
  callback,
  cancelToken,
}): Promise<unknown> => {
  const entities = store.getState().entities.entities;
  const ProxyTrunk = entities.ProxyTrunk;

  return defaultEntityBehavior.fetchFks(
    `${ProxyTrunk.path}?_order[ip]=ASC`,
    ['id', 'ip'],
    (data) => {
      const options: DropdownChoices = [];
      for (const item of data) {
        options.push({ id: item.id, label: item.ip });
      }

      callback(options);
    },
    cancelToken
  );
};

export default ProxyTrunkSelectOptions;
