import { autoForeignKeyResolver } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { foreignKeyResolverType } from '@irontec/ivoz-ui/entities/EntityInterface';
import genericForeignKeyResolver from '@irontec/ivoz-ui/services/api/genericForeigKeyResolver';
import { getI18n } from 'react-i18next';
import store from 'store';

import { CountryPropertyList } from '../Country/CountryProperties';
import { SpecialNumberPropertiesList } from './SpecialNumberProperties';

/** TODO remove this file unless you need to change default behaviour **/
const foreignKeyResolver: foreignKeyResolverType = async function ({
  data,
  cancelToken,
  entityService,
}): Promise<SpecialNumberPropertiesList> {
  const entities = store.getState().entities.entities;

  const promises = autoForeignKeyResolver({
    data,
    cancelToken,
    entityService,
    skip: ['country'],
  });

  promises.push(
    genericForeignKeyResolver({
      data,
      fkFld: 'country',
      entity: {
        ...entities.Country,
        toStr: (row: CountryPropertyList) => {
          const language = getI18n().language.substring(0, 2);

          return `${row.name[language]} (${row.countryCode})`;
        },
      },
      cancelToken,
    })
  );

  await Promise.all(promises);

  return data;
};

export default foreignKeyResolver;
