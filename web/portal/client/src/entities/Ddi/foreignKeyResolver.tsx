import { EntityValues } from '@irontec/ivoz-ui';
import { autoForeignKeyResolver } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { foreignKeyResolverType } from '@irontec/ivoz-ui/entities/EntityInterface';
import genericForeignKeyResolver, {
  remapFk,
} from '@irontec/ivoz-ui/services/api/genericForeigKeyResolver';
import { CountryPropertyList } from '../Country/CountryProperties';
import store from 'store';
import { getI18n } from 'react-i18next';
import { DdiPropertiesList } from './DdiProperties';

const foreignKeyResolver: foreignKeyResolverType = async function ({
  data,
  cancelToken,
  entityService,
}): Promise<DdiPropertiesList> {
  const entities = store.getState().entities.entities;
  const { Country } = entities;

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
        ...Country,
        toStr: (row: CountryPropertyList<EntityValues>) => {
          const language = getI18n().language.substring(0, 2);
          return `${(row.name as EntityValues)[language]} (${row.countryCode})`;
        },
      },
      addLink: false,
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
      case 'fax':
        remapFk(data[idx], 'fax', 'target');
        break;
      case 'conferenceRoom':
        remapFk(data[idx], 'conferenceRoom', 'target');
        break;
      case 'friend':
        remapFk(data[idx], 'friendValue', 'target');
        break;
      case 'queue':
        remapFk(data[idx], 'queue', 'target');
        break;
      case 'residential':
        remapFk(data[idx], 'residentialDevice', 'target');
        break;
      case 'conditional':
        remapFk(data[idx], 'conditionalRoute', 'target');
        break;
      case 'retail':
        remapFk(data[idx], 'retailAccount', 'target');
        break;
      default:
        console.error('Unkown route type ' + data[idx].routeType);
        data[idx].target = '';
        break;
    }

    delete data[idx].user;
    delete data[idx].ivr;
    delete data[idx].huntGroup;
    delete data[idx].fax;
    delete data[idx].conferenceRoom;
    delete data[idx].residentialDevice;
    delete data[idx].friendValue;
    delete data[idx].queue;
    delete data[idx].conditionalRoute;
    delete data[idx].retailAccount;
  }

  return data;
};

export default foreignKeyResolver;
