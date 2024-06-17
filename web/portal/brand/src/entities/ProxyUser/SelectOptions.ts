import { DropdownChoices } from '@irontec-voip/ivoz-ui';
import defaultEntityBehavior from '@irontec-voip/ivoz-ui/entities/DefaultEntityBehavior';
import { SelectOptionsType } from '@irontec-voip/ivoz-ui/entities/EntityInterface';
import store from 'store';

import { ProxyUserPropertiesList } from './ProxyUserProperties';

const ProxyUserSelectOptions: SelectOptionsType = ({
  callback,
  cancelToken,
}): Promise<unknown> => {
  const entities = store.getState().entities.entities;
  const ProxyUser = entities.ProxyUser;

  return defaultEntityBehavior.fetchFks(
    ProxyUser.path,
    null,
    (data: ProxyUserPropertiesList) => {
      const options: DropdownChoices = [];
      for (const item of data) {
        const ip: string = item.advertisedIp ? item.advertisedIp : item.ip;

        const label = `${item.name} (${ip})`;
        options.push({ id: item.id as number, label: label });
      }

      callback(options);
    },
    cancelToken
  );
};

export default ProxyUserSelectOptions;
