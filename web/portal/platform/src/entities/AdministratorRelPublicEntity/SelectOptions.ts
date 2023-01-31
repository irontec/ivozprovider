import { DropdownChoices, EntityValues } from '@irontec/ivoz-ui';
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
    ['id', 'administrator'],
    (data: Array<EntityValues>) => {
      const options: DropdownChoices = [];
      for (const item of data) {
        options.push({
          id: item.id as number,
          label: (item.administrator as Record<string, string>).name,
        });
      }

      callback(options);
    },
    cancelToken
  );
};

export default AdministratorRelPublicEntitySelectOptions;
