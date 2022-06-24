import { autoForeignKeyResolver } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { foreignKeyResolverType } from '@irontec/ivoz-ui/entities/EntityInterface';
import genericForeignKeyResolver, {
  remapFk,
} from '@irontec/ivoz-ui/services/api/genericForeigKeyResolver';
import entities from '../index';
import { ExtensionPropertiesList } from './ExtensionProperties';

const foreignKeyResolver: foreignKeyResolverType = async function ({
  data,
  cancelToken,
  entityService,
}): Promise<ExtensionPropertiesList> {
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
        toStr: (row: any) => `${row.countryCode}`,
      },
      cancelToken,
    })
  );

  await Promise.all(promises);

  if (!Array.isArray(data)) {
    return data;
  }

  for (const idx in data) {
    switch (data[idx].routeType) {
      case 'user':
        remapFk(data[idx], 'user', 'target');
        break;
      case 'ivr':
        remapFk(data[idx], 'ivr', 'target');
        break;
      case 'huntGroup':
        remapFk(data[idx], 'huntGroup', 'target');
        break;
      case 'conferenceRoom':
        remapFk(data[idx], 'conferenceRoom', 'target');
        break;
      case 'number':
        data[idx].target =
          data[idx].numberCountry + ' ' + data[idx].numberValue;
        break;
      case 'friend':
        data[idx].target = data[idx].friendValue;
        break;
      case 'queue':
        remapFk(data[idx], 'queue', 'target');
        break;
      case 'conditional':
        remapFk(data[idx], 'conditionalRoute', 'target');
        break;
      case 'voicemail':
        remapFk(data[idx], 'voicemail', 'target');
        break;
      case null:
        data[idx].target = '';
        break;
      default:
        console.error('Unkown route type ' + data[idx].routeType);
        data[idx].target = '';
        break;
    }

    delete data[idx].user;
    delete data[idx].ivr;
    delete data[idx].huntGroup;
    delete data[idx].conferenceRoom;
    delete data[idx].numberCountry;
    delete data[idx].numberValue;
    delete data[idx].friendValue;
    delete data[idx].queue;
    delete data[idx].conditionalRoute;
    delete data[idx].voicemail;
  }

  return data;
};

export default foreignKeyResolver;
