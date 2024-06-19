import { DropdownChoices } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import { getI18n } from 'react-i18next';
import store from 'store';

import { CurrencyPropertiesList } from './CurrencyProperties';

const CurrencySelectOptions: SelectOptionsType = ({
  callback,
  cancelToken,
}): Promise<unknown> => {
  const entities = store.getState().entities.entities;
  const language = getI18n().language.substring(0, 2);
  const Currency = entities.Currency;

  return defaultEntityBehavior.fetchFks(
    `${Currency.path}?_order[name.${[language]}]=ASC`,
    ['id', 'name', 'symbol'],
    (data: CurrencyPropertiesList) => {
      const options: DropdownChoices = [];
      for (const item of data) {
        const name = item.name as Record<string, string>;
        options.push({
          id: item.id as number,
          label: `${name[language]} (${item.symbol})`,
        });
      }

      callback(options);
    },
    cancelToken
  );
};

export default CurrencySelectOptions;
