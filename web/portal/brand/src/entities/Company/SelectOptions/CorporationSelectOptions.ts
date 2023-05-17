import { DropdownArrayChoices } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import { CorporationPropertiesList } from 'entities/Corporation/CorporationProperties';
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
      const options: DropdownArrayChoices = [];
      for (const item of data) {
        options.push({
          id: item.id,
          label: item.name,
        });
      }

      callback(options);
    },
    cancelToken
  );
};

export default CorporationSelectOptions;
