import { autoForeignKeyResolver } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { foreignKeyResolverType } from '@irontec/ivoz-ui/entities/EntityInterface';
import genericForeignKeyResolver, {
  remapFk,
} from '@irontec/ivoz-ui/services/api/genericForeigKeyResolver';
import store from 'store';

import { CountryPropertyList } from '../Country/CountryProperties';
import { IvrPropertiesList } from './IvrProperties';

const foreignKeyResolver: foreignKeyResolverType = async function ({
  data,
  cancelToken,
  entityService,
}): Promise<IvrPropertiesList> {
  const entities = store.getState().entities.entities;
  const { Country } = entities;

  const promises = autoForeignKeyResolver({
    data,
    cancelToken,
    entityService,
    skip: ['noInputNumberCountry', 'errorNumberCountry'],
  });

  promises.push(
    genericForeignKeyResolver({
      data,
      fkFld: 'noInputNumberCountry',
      entity: {
        ...Country,
        toStr: (row: CountryPropertyList<string>) => `${row.countryCode}`,
      },
      cancelToken,
    })
  );

  promises.push(
    genericForeignKeyResolver({
      data,
      fkFld: 'errorNumberCountry',
      entity: {
        ...Country,
        toStr: (row: CountryPropertyList<string>) => `${row.countryCode}`,
      },
      cancelToken,
    })
  );

  await Promise.all(promises);

  if (!Array.isArray(data)) {
    return data;
  }

  for (const idx in data) {
    switch (data[idx].noInputRouteType) {
      case 'number':
        data[
          idx
        ].errorTarget = `${data[idx].noInputNumberCountry} ${data[idx].noInputNumberValue}`;
        break;
      case 'extension':
        remapFk(data[idx], 'noInputExtension', 'noInputTarget');
        break;
      case 'voicemail':
        remapFk(data[idx], 'noInputVoicemail', 'noInputTarget');
        break;
      default:
        // eslint-disable-next-line no-console
        console.error(`Unkown route type ${data[idx].noInputRouteType}`);
        data[idx].noInputTarget = '';
        break;
    }

    switch (data[idx].errorRouteType) {
      case 'number':
        data[
          idx
        ].errorTarget = `${data[idx].errorNumberCountry} ${data[idx].errorNumberValue}`;
        break;
      case 'extension':
        remapFk(data[idx], 'errorExtension', 'errorTarget');
        break;
      case 'voicemail':
        remapFk(data[idx], 'errorVoicemail', 'errorTarget');
        break;
      default:
        // eslint-disable-next-line no-console
        console.error(`Unkown route type ${data[idx].errorRouteType}`);
        data[idx].errorTarget = '';
        break;
    }

    delete data[idx].noInputNumberCountryId;
    delete data[idx].noInputNumberValue;
    delete data[idx].noInputExtensionId;
    delete data[idx].noInputVoicemailId;

    delete data[idx].errorNumberCountryId;
    delete data[idx].errorNumberValue;
    delete data[idx].errorExtensionId;
    delete data[idx].errorVoicemailId;
  }

  return data;
};

export default foreignKeyResolver;
