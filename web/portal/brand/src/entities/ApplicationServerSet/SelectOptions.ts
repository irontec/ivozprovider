import { DropdownChoices } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import store from 'store';

import { ApplicationServerSetPropertiesList } from './ApplicationServerSetProperties';

const ApplicationServerSetSelectOptions: SelectOptionsType = ({
  callback,
  cancelToken,
}): Promise<unknown> => {
  const entities = store.getState().entities.entities;
  const ApplicationServerSet = entities.ApplicationServerSet;

  return defaultEntityBehavior.fetchFks(
    ApplicationServerSet.path,
    ['id', 'name'],
    (data: ApplicationServerSetPropertiesList) => {
      const options: DropdownChoices = [];
      for (const item of data) {
        options.push({
          id: item.id as number,
          label: item.name as string,
        });
      }

      callback(options);
    },
    cancelToken
  );
};

export default ApplicationServerSetSelectOptions;
