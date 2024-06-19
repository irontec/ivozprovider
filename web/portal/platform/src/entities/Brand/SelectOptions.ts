import { DropdownChoices } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import store from 'store';

import { BrandPropertiesList } from './BrandProperties';

const BrandSelectOptions: SelectOptionsType = ({
  callback,
  cancelToken,
}): Promise<unknown> => {
  const entities = store.getState().entities.entities;
  const Brand = entities.Brand;

  return defaultEntityBehavior.fetchFks(
    Brand.path,
    ['id', 'name'],
    (data: BrandPropertiesList) => {
      const options: DropdownChoices = [];

      for (const item of data) {
        options.push({ id: item.id as number, label: item.name as string });
      }

      callback(options);
    },
    cancelToken
  );
};

export default BrandSelectOptions;
