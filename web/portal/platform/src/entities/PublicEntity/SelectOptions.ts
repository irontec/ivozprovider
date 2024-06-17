import { DropdownArrayChoices } from '@irontec-voip/ivoz-ui';
import defaultEntityBehavior from '@irontec-voip/ivoz-ui/entities/DefaultEntityBehavior';
import { SelectOptionsType } from '@irontec-voip/ivoz-ui/entities/EntityInterface';
import store from 'store';

import { PublicEntityPropertiesList } from './PublicEntityProperties';

const PublicEntitySelectOptions: SelectOptionsType = ({
  callback,
  cancelToken,
}): Promise<unknown> => {
  const entities = store.getState().entities.entities;
  const PublicEntity = entities.PublicEntity;

  return defaultEntityBehavior.fetchFks(
    PublicEntity.path,
    ['id', 'name'],
    (data: PublicEntityPropertiesList) => {
      const options: DropdownArrayChoices = [];

      for (const item of data) {
        options.push({
          id: item.id as string,
          label: PublicEntity.toStr(item),
        });
      }

      callback(options);
    },
    cancelToken
  );
};

export default PublicEntitySelectOptions;
