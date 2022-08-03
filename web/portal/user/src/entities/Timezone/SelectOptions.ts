import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import store from 'store';

const selectOptions: SelectOptionsType = ({
  callback,
  cancelToken,
}): Promise<unknown> => {

  const entities = store.getState().entities.entities;
  const Timezone = entities.Timezone;

  return defaultEntityBehavior.fetchFks(
    Timezone.path,
    ['id', 'tz'],
    (data: any) => {
      const options: any = {};
      for (const item of data) {
        options[item.id] = item.tz;
      }

      callback(options);
    },
    cancelToken
  );
};

export default selectOptions;
