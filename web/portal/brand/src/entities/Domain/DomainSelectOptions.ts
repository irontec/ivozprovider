import { DropdownChoices } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import store from 'store';

import { DomainPropertiesList } from './DomainProperties';

const DomainSelectOptions: SelectOptionsType = ({
  callback,
  cancelToken,
}): Promise<unknown> => {
  const entities = store.getState().entities.entities;
  const Domain = entities.Domain;

  return defaultEntityBehavior.fetchFks(
    Domain.path,
    ['id', 'domain'],
    (data: DomainPropertiesList) => {
      const options: DropdownChoices = [];
      for (const item of data) {
        options.push({
          id: item.id as number,
          label: `${item.domain}` as string,
        });
      }

      callback(options);
    },
    cancelToken
  );
};

export default DomainSelectOptions;
