import { DropdownChoices } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import { getI18n } from 'react-i18next';
import store from 'store';

import { CountryPropertiesList } from './CountryProperties';

const CountrySelectOptions: SelectOptionsType = ({
  callback,
  cancelToken,
}): Promise<unknown> => {
  const entities = store.getState().entities.entities;
  const Country = entities.Country;
  const language = getI18n().language.substring(0, 2);

  return defaultEntityBehavior.fetchFks(
    `${Country.path}?_order[name.${[language]}]=ASC`,
    ['id', 'name', 'countryCode'],
    (data: CountryPropertiesList) => {
      const options: DropdownChoices = [];
      for (const item of data) {
        const name = item.name as Record<string, string>;

        options.push({
          id: item.id as number,
          label: `${name[language]} (${item.countryCode})`,
        });
      }

      callback(options);
    },
    cancelToken
  );
};

export default CountrySelectOptions;
