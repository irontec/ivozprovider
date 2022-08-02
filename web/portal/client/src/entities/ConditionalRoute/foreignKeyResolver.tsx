import { autoForeignKeyResolver } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { foreignKeyResolverType } from '@irontec/ivoz-ui/entities/EntityInterface';
import genericForeignKeyResolver, {
  remapFk,
} from '@irontec/ivoz-ui/services/api/genericForeigKeyResolver';
import { CountryPropertyList } from 'entities/Country/CountryProperties';
import store from 'store';
import { ConditionalRoutePropertiesList } from './ConditionalRouteProperties';

const foreignKeyResolver: foreignKeyResolverType = async function ({
  data,
  cancelToken,
  entityService,
}): Promise<ConditionalRoutePropertiesList> {
  const entities = store.getState().entities.entities;
  const { Country } = entities;

  const promises = autoForeignKeyResolver({
    data,
    cancelToken,
    entityService,
    entities,
    skip: ['numberCountry'],
  });

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

  if (!Array.isArray(data)) {
    return data;
  }

  for (const idx in data) {
    switch (data[idx].routetype) {
      case 'user':
        remapFk(data[idx], 'user', 'target');
        break;
      case 'ivr':
        remapFk(data[idx], 'ivr', 'target');
        break;
      case 'huntGroup':
        remapFk(data[idx], 'huntGroup', 'target');
        break;
      case 'voicemail':
        remapFk(data[idx], 'voicemail', 'target');
        break;
      case 'number':
        data[idx].target =
          data[idx].numberCountry + ' ' + data[idx].numbervalue;
        break;
      case 'friend':
        data[idx].target = data[idx].friendvalue;
        break;
      case 'queue':
        remapFk(data[idx], 'queue', 'target');
        break;
      case 'conferenceRoom':
        remapFk(data[idx], 'conferenceRoom', 'target');
        break;
      case 'extension':
        remapFk(data[idx], 'extension', 'target');
        break;
      default:
        console.error('Unkown route type:', data[idx].routetype);
        data[idx].target = '';
        break;
    }

    delete data[idx].user;
    delete data[idx].ivr;
    delete data[idx].huntGroup;
    delete data[idx].voicemail;
    delete data[idx].numbervalue;
    delete data[idx].friendvalue;
    delete data[idx].queue;
    delete data[idx].conferenceRoom;
    delete data[idx].extension;
  }

  return data;
};

export default foreignKeyResolver;
