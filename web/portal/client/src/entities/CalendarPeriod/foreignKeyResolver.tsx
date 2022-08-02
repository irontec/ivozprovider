import { autoForeignKeyResolver } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { foreignKeyResolverType } from '@irontec/ivoz-ui/entities/EntityInterface';
import genericForeignKeyResolver, {
  remapFk,
} from '@irontec/ivoz-ui/services/api/genericForeigKeyResolver';
import { CountryPropertyList } from 'entities/Country/CountryProperties';
import store from 'store';
import { CalendarPeriodPropertiesList } from './CalendarPeriodProperties';

const foreignKeyResolver: foreignKeyResolverType = async function ({
  data,
  cancelToken,
  entityService,
}): Promise<CalendarPeriodPropertiesList> {
  const entities = store.getState().entities.entities;

  const promises = autoForeignKeyResolver({
    data,
    cancelToken,
    entityService,
    skip: ['scheduleIds', 'numberCountry', 'calendar'],
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
  const { Schedule } = entities;

  const scheduleIds: number[] = [];
  for (const idx in data) {
    const newItems = (data[idx].scheduleIds as number[]).filter((value) => {
      return scheduleIds.indexOf(value) < 0;
    });
    scheduleIds.push(...newItems);
  }

  promises[promises.length] = getAction({
    path: Schedule.path,
    params: {
      calendarPeriod: scheduleIds,
      _pagination: false,
    },
    cancelToken: cancelToken,
    successCallback: async (response: any) => {
      for (const schedule of response) {
        for (const row of data) {
          for (const idx in row.scheduleIds) {
            if (schedule?.id !== row.scheduleIds[idx]) {
              continue;
            }

            row.scheduleIds[idx] = Schedule.toStr(schedule);
          }
        }
      }
    },
  });

  await Promise.all(promises);

  if (!Array.isArray(data)) {
    return data;
  }

  for (const idx in data) {
    data[idx].scheduleIds = data[idx].scheduleIds.join(', ');

    switch (data[idx].routeType) {
      case 'voicemail':
        remapFk(data[idx], 'voicemail', 'target');
        break;
      case 'number':
        data[idx].target =
          data[idx].numberCountry + ' ' + data[idx].numberValue;
        break;
      case 'extension':
        remapFk(data[idx], 'extension', 'target');
        break;
      default:
        console.error('Unkown route type:', data[idx].routetype);
        data[idx].target = '';
        break;
    }
  }

  return data;
};

export default foreignKeyResolver;
