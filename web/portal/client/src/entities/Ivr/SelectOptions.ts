import { DropdownChoices } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import store from 'store';

const IvrSelectOptions: SelectOptionsType = ({
  callback,
  cancelToken,
}): Promise<unknown> => {
  const entities = store.getState().entities.entities;
  const Ivr = entities.Ivr;

  return defaultEntityBehavior.fetchFks(
    Ivr.path,
    ['id', 'name'],
    (data) => {
      const options: DropdownChoices = {};
      for (const item of data) {
        options[item.id] = item.name;
      }

      callback(options);
    },
    cancelToken
  );
};

export default IvrSelectOptions;
