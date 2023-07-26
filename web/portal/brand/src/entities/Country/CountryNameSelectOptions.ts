import { DropdownChoices } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import store from 'store';

const CountryNameSelectOptions: SelectOptionsType = ({
  callback,
  cancelToken,
}): Promise<unknown> => {
  const entities = store.getState().entities.entities;
  const Country = entities.Country;

  return defaultEntityBehavior.fetchFks(
    Country.path,
    ['id', 'name'],
    (data) => {
      const options: DropdownChoices = {};
      for (const item of data) {
        options[item.id] = `${Country.toStr(item)}`;
      }

      callback(options);
    },
    cancelToken
  );
};

export default CountryNameSelectOptions;
