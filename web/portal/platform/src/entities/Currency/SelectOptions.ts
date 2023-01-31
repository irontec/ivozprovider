import { DropdownChoices, EntityValues } from '@irontec/ivoz-ui';
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
    (data: Array<EntityValues>) => {
      const options: DropdownChoices = [];
      for (const item of data) {
        options.push({
          id: item.id as number,
          label: `${(item.name as Record<string, string>).en}  (${
            item.symbol
          })`,
        });
      }

      callback(options);
    },
    cancelToken
  );
};

export default CurrencySelectOptions;
