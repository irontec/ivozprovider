import { CallForwardSettingPropertiesList } from './CallForwardSettingProperties';
import entities from '../index';
import genericForeignKeyResolver, {
  remapFk,
} from '@irontec/ivoz-ui/services/api/genericForeigKeyResolver';
import { foreignKeyResolverType } from '@irontec/ivoz-ui/entities/EntityInterface';
import { autoForeignKeyResolver } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { CountryPropertyList } from 'entities/Country/CountryProperties';

const foreignKeyResolver: foreignKeyResolverType = async function ({
  data,
  cancelToken,
  entityService,
}): Promise<CallForwardSettingPropertiesList> {
  const promises = autoForeignKeyResolver({
    data,
    cancelToken,
    entityService,
    entities,
    skip: ['numberCountry', 'user'],
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
    })
  );

  await Promise.all(promises);

  for (const values of data) {
    switch (values.targetType) {
      case 'extension':
        remapFk(values, 'extension', 'targetTypeValue');
        break;
      case 'voicemail':
        remapFk(values, 'voicemail', 'targetTypeValue');
        break;
      case 'retail':
        remapFk(values, 'cfwToretailAccount', 'targetTypeValue');
        break;
      case 'number':
        values.targetTypeValue = `${values.numberCountry} ${values.numberValue}`;
        break;
    }
  }

  return data;
};

export default foreignKeyResolver;
