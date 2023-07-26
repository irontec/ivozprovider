import { DropdownChoices } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import store from 'store';

const selectOptions: SelectOptionsType = ({
  callback,
  cancelToken,
}): Promise<unknown> => {
  const entities = store.getState().entities.entities;
  const Voicemail = entities.Voicemail;

  return defaultEntityBehavior.fetchFks(
    Voicemail.path,
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

export default selectOptions;
