import { DropdownChoices } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import store from 'store';

import { DdiPropertiesList } from './DdiProperties';

const DdiSelectOptions: SelectOptionsType = ({
  callback,
  cancelToken,
}): Promise<unknown> => {
  const entities = store.getState().entities.entities;
  const Ddi = entities.Ddi;

  return defaultEntityBehavior.fetchFks(
    Ddi.path,
    ['id', 'ddie164'],
    (data: DdiPropertiesList) => {
      const options: DropdownChoices = [];

      for (const item of data) {
        options.push({
          id: item.id as number,
          label: Ddi.toStr(item),
        });
      }

      callback(options);
    },
    cancelToken
  );
};

export default DdiSelectOptions;
