import { EntityValues } from '@irontec/ivoz-ui';
import { autoForeignKeyResolver } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { foreignKeyResolverType } from '@irontec/ivoz-ui/entities/EntityInterface';
import genericForeignKeyResolver from '@irontec/ivoz-ui/services/api/genericForeigKeyResolver';
import { getI18n } from 'react-i18next';
import store from 'store';

import genericCompanyForeignKeyResolver from '../Company/genericCompanyForeignKeyResolver';
import { CountryPropertyList } from '../Country/CountryProperties';
import { DdiPropertiesList } from './DdiProperties';

const foreignKeyResolver: foreignKeyResolverType = async function ({
  data,
  cancelToken,
  entityService,
}): Promise<DdiPropertiesList> {
  const entities = store.getState().entities.entities;

  const promises = autoForeignKeyResolver({
    data,
    cancelToken,
    entityService,
    skip: ['country', 'company'],
  });

  promises.push(
    genericForeignKeyResolver({
      data,
      fkFld: 'country',
      addLink: false,
      entity: {
        ...entities.Country,
        toStr: (row: CountryPropertyList<EntityValues>) => {
          const language = getI18n().language.substring(0, 2);

          return `${(row.name as EntityValues)[language]} (${row.countryCode})`;
        },
      },
      cancelToken,
    })
  );

  promises.push(
    genericCompanyForeignKeyResolver({
      data,
      fkFld: 'company',
      cancelToken,
    })
  );

  await Promise.all(promises);

  return data;
};

export default foreignKeyResolver;
