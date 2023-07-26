import { DropdownChoices } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import store from 'store';

const AdministratorRelPublicEntitySelectOptions: SelectOptionsType = ({
  callback,
  cancelToken,
}): Promise<unknown> => {
  const entities = store.getState().entities.entities;
  const AdministratorRelPublicEntity = entities.AdministratorRelPublicEntity;

  return defaultEntityBehavior.fetchFks(
    AdministratorRelPublicEntity.path,
    ['id'],
    (data) => {
      const options: DropdownChoices = {};
      for (const item of data) {
        options[item.id] = item.id;
      }

      callback(options);
    },
    cancelToken
  );
};

export default AdministratorRelPublicEntitySelectOptions;
