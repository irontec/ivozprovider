import { autoForeignKeyResolver } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { foreignKeyResolverType } from '@irontec/ivoz-ui/entities/EntityInterface';
import genericForeignKeyResolver, {
  remapFk,
} from '@irontec/ivoz-ui/services/api/genericForeigKeyResolver';
import { CountryPropertyList } from 'entities/Country/CountryProperties';
import store from 'store';

import { IvrEntryPropertiesList } from './IvrEntryProperties';

const foreignKeyResolver: foreignKeyResolverType = async function ({
  data,
  cancelToken,
  entityService,
}): Promise<IvrEntryPropertiesList> {
  const entities = store.getState().entities.entities;
  const promises = autoForeignKeyResolver({
    data,
    cancelToken,
    entityService,
    skip: ['numberCountry', 'ivr'],
  });

  const { Country } = entities;
  promises.push(
    genericForeignKeyResolver({
      data,
      fkFld: 'numberCountry',
      entity: {
        ...Country,
        toStr: (row: CountryPropertyList<string>) => row.countryCode as string,
      },
      cancelToken,
    })
  );

  await Promise.all(promises);

  for (const values of data) {
    switch (values.routeType) {
      case 'extension':
        remapFk(values, 'extension', 'target');
        break;
      case 'voicemail':
        remapFk(values, 'voicemail', 'target');
        break;
      case 'conditional':
        remapFk(values, 'conditionalRoute', 'target');
        break;
      case 'number':
        values.target = `${values.numberCountry} ${values.numberValue}`;
        break;
    }
  }

  return data;
};

export default foreignKeyResolver;
