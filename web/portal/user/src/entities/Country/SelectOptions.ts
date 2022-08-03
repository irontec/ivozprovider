import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import store from 'store';

const selectOptions: SelectOptionsType = ({
  callback,
  cancelToken,
}): Promise<unknown> => {

  const entities = store.getState().entities.entities;
  const Country = entities.Country;

  return defaultEntityBehavior.fetchFks(
    Country.path,
    ['id', 'name', 'countryCode'],
    (data: any) => {
      const options: any = {};
      for (const item of data) {
        options[item.id] = `${Country.toStr(item)} (${item.countryCode})`;
      }

      callback(options);
    },
    cancelToken
  );
};

export default selectOptions;
