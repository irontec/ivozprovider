import { foreignKeyResolverType } from '@irontec-voip/ivoz-ui/entities/EntityInterface';
import genericForeignKeyResolver from '@irontec-voip/ivoz-ui/services/api/genericForeigKeyResolver';
import { EntityValues } from '@irontec-voip/ivoz-ui/services/entity/EntityService';
import { CountryPropertyList } from 'entities/Country/CountryProperties';
import store from 'store';

const foreignKeyResolver: foreignKeyResolverType = async function ({
  data,
  cancelToken,
}): Promise<EntityValues> {
  const promises: Array<Promise<unknown>> = [];

  const entities = store.getState().entities.entities;
  promises.push(
    genericForeignKeyResolver({
      data,
      fkFld: 'numberCountry',
      entity: {
        ...entities.Country,
        toStr: (row: CountryPropertyList<string>) => `${row.countryCode}`,
      },
      cancelToken,
    })
  );

  await Promise.all(promises);

  return data;
};

export default foreignKeyResolver;
