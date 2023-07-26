import { autoForeignKeyResolver } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { foreignKeyResolverType } from '@irontec/ivoz-ui/entities/EntityInterface';
import { EntityList } from '@irontec/ivoz-ui/router/parseRoutes';
import genericForeignKeyResolver, {
  remapFk,
} from '@irontec/ivoz-ui/services/api/genericForeigKeyResolver';
import store from 'store';

import { CountryPropertyList } from '../Country/CountryProperties';
import { ConditionalRoutesConditionPropertiesList } from './ConditionalRoutesConditionProperties';

const foreignKeyResolver: foreignKeyResolverType = async function ({
  data,
  cancelToken,
  entityService,
}): Promise<ConditionalRoutesConditionPropertiesList> {
  const entities = store.getState().entities.entities;
  const promises = autoForeignKeyResolver({
    data,
    cancelToken,
    entityService,
    skip: ['numberCountry', 'conditionalRoute'],
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

  const getAction = store.getActions().api.get;
  const {
    ConditionalRoutesConditionsRelCalendar,
    ConditionalRoutesConditionsRelMatchList,
    ConditionalRoutesConditionsRelRouteLock,
    ConditionalRoutesConditionsRelSchedule,
  } = entities;

  const conditionMatchEntities: EntityList = {
    calendar: ConditionalRoutesConditionsRelCalendar,
    matchlist: ConditionalRoutesConditionsRelMatchList,
    routeLock: ConditionalRoutesConditionsRelRouteLock,
    schedule: ConditionalRoutesConditionsRelSchedule,
  };

  const ids = [];
  for (const idx in data) {
    ids.push(data[idx].id);
  }

  for (const fld in conditionMatchEntities) {
    const entity = conditionMatchEntities[fld];
    promises[promises.length] = getAction({
      path: entity.path,
      params: {
        condition: ids,
        _pagination: false,
      },
      cancelToken: cancelToken,
      successCallback: async (response) => {
        for (const item of response as Array<Record<string, unknown>>) {
          for (const row of data as Array<Record<string, unknown>>) {
            const condition = item.condition as { id: number };
            if (condition.id !== row.id) {
              continue;
            }

            if (row.conditionMatch === undefined) {
              row.conditionMatch = [];
            }

            (row.conditionMatch as Array<unknown>).push(
              (item[fld] as Record<string, string>).name
            );
          }
        }
      },
    });
  }

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
      case 'voicemail':
        remapFk(data[idx], 'voicemail', 'target');
        break;
      case 'number':
        data[
          idx
        ].target = `${data[idx].numberCountry} ${data[idx].numbervalue}`;
        break;
      case 'friend':
        data[idx].target = data[idx].friendValue;
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
        // eslint-disable-next-line no-console
        console.error('Unkown route type:', data[idx].routetype);
        data[idx].target = '';
        break;
    }
  }

  return data;
};

export default foreignKeyResolver;
