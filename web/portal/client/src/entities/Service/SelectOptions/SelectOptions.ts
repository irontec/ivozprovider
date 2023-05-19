import { DropdownChoices } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import store from 'store';

const SelectOptions: SelectOptionsType = (props): Promise<unknown> => {
  const { callback, cancelToken } = props;

  const entities = store.getState().entities.entities;
  const Service = entities.Service;

  return defaultEntityBehavior.fetchFks(
    Service.path,
    ['id', 'name'],
    (data) => {
      const options: DropdownChoices = {};
      for (const item of data) {
        options[item.id] = Service.toStr(item);
      }

      callback(options);
    },
    cancelToken
  );
};

export default SelectOptions;
