import { DropdownChoices } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import store from 'store';
import { RetailAccountPropertiesList } from '../RetailAccountProperties';

const RetailAccountSelectOptions: SelectOptionsType = ({
  callback,
  cancelToken,
}): Promise<unknown> => {
  const entities = store.getState().entities.entities;
  const RetailAccount = entities.RetailAccount;

  return defaultEntityBehavior.fetchFks(
    RetailAccount.path,
    ['id', 'name'],
    (data: RetailAccountPropertiesList) => {
      const options: DropdownChoices = [];
      for (const item of data) {
        options.push({ id: item.id as number, label: item.name as string });
      }

      callback(options);
    },
    cancelToken
  );
};

export default RetailAccountSelectOptions;
