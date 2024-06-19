import { DropdownChoices, EntityValues } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import store from 'store';

const TimezoneSelectOptions: SelectOptionsType = ({
  callback,
  cancelToken,
}): Promise<unknown> => {
  const entities = store.getState().entities.entities;
  const Timezone = entities.Timezone;

  return defaultEntityBehavior.fetchFks(
    Timezone.path,
    ['id', 'tz'],
    (data: Array<EntityValues>) => {
      const options: DropdownChoices = [];
      for (const item of data) {
        options.push({ id: item.id as number, label: item.tz as string });
      }

      callback(options);
    },
    cancelToken
  );
};

export default TimezoneSelectOptions;
