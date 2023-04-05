import { DropdownChoices } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import store from 'store';
import { CountryPropertiesList } from './CountryProperties';

const CountryNameSelectOptions: SelectOptionsType = ({
  callback,
  cancelToken,
}): Promise<unknown> => {
  const entities = store.getState().entities.entities;
  const Country = entities.Country;

  return defaultEntityBehavior.fetchFks(
    Country.path,
    ['id', 'name'],
    (data: CountryPropertiesList) => {
      const options: DropdownChoices = [];
      for (const item of data) {
        options.push({
          id: item.id as number,
          label: Country.toStr(item),
        });
      }

      callback(options);
    },
    cancelToken
  );
};

export default CountryNameSelectOptions;
