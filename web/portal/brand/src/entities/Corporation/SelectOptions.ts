import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import { CorporationPropertiesList } from './CorporationProperties';
import { DropdownChoices } from '@irontec/ivoz-ui';
import store from 'store';

const CorporationSelectOptions: SelectOptionsType = ({
  callback,
  cancelToken,
}): Promise<unknown> => {
  const entities = store.getState().entities.entities;
  const Corporation = entities.Corporation;

  return defaultEntityBehavior.fetchFks(
    Corporation.path,
    ['id', 'name'],
    (data: CorporationPropertiesList) => {
      const options: DropdownChoices = [];
      for (const item of data) {
        options.push({ id: item.id as number, label: item.name as string });
      }

      callback(options);
    },
    cancelToken
  );
};

export default CorporationSelectOptions;
