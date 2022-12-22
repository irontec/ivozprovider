import { DropdownChoices } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import store from 'store';

const RetailSelectOptions: SelectOptionsType = ({
  callback,
  cancelToken,
}): Promise<unknown> => {
  const entities = store.getState().entities.entities;
  const Company = entities.Company;

  return defaultEntityBehavior.fetchFks(
    Company.path + '?type=retail&_order[name]=ASC',
    ['id', 'name', 'company'],
    (data: any) => {
      const options: DropdownChoices = [];
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

export default RetailSelectOptions;
