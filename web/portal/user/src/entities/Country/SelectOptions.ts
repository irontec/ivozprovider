import { DropdownChoices } from '@irontec-voip/ivoz-ui';
import defaultEntityBehavior from '@irontec-voip/ivoz-ui/entities/DefaultEntityBehavior';
import { SelectOptionsType } from '@irontec-voip/ivoz-ui/entities/EntityInterface';
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
    (data) => {
      const options: DropdownChoices = {};
      for (const item of data) {
        options[item.id] = `${Country.toStr(item)} (${item.countryCode})`;
      }

      callback(options);
    },
    cancelToken
  );
};

export default selectOptions;
