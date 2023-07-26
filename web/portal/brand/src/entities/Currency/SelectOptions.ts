import { DropdownChoices } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import store from 'store';

const CurrencySelectOptions: SelectOptionsType = ({
  callback,
  cancelToken,
}): Promise<unknown> => {
  const entities = store.getState().entities.entities;
  const Currency = entities.Currency;

  return defaultEntityBehavior.fetchFks(
    Currency.path,
    ['id', 'name', 'symbol'],
    (data) => {
      const options: DropdownChoices = {};
      for (const item of data) {
        options[item.id] = Currency.toStr(item);
      }

      callback(options);
    },
    cancelToken
  );
};

export default CurrencySelectOptions;
