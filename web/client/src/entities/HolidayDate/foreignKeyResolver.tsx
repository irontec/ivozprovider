import { foreignKeyResolverType } from '@irontec/ivoz-ui/entities/EntityInterface';
import { HolidayDatePropertiesList } from './HolidayDateProperties';
import entities from '../index';
import { autoForeignKeyResolver } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import genericForeignKeyResolver, { remapFk } from '@irontec/ivoz-ui/services/api/genericForeigKeyResolver';
import { CountryPropertyList } from 'entities/Country/CountryProperties';

const foreignKeyResolver: foreignKeyResolverType = async function (
  { data, cancelToken, entityService },
): Promise<HolidayDatePropertiesList> {

  const promises = autoForeignKeyResolver({
    data,
    cancelToken,
    entityService,
    entities,
    skip: [
      'numberCountry',
      'calendar',
    ],
  });

  promises.push(
    genericForeignKeyResolver({
      data,
      fkFld: 'numberCountry',
      entity: {
        ...entities.Country,
        toStr: (row: CountryPropertyList<string>) => `${row.countryCode}`,
      },
      cancelToken,
    }),
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
      case 'retail':
        remapFk(values, 'cfwToretailAccount', 'target');
        break;
      case 'number':
        values.targetTypeValue = `${values.numberCountry} ${values.numberValue}`;
        break;
    }
  }

  return data;
};

export default foreignKeyResolver;