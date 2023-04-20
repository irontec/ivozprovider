import { DropdownArrayChoices, EntityValues } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import { getI18n } from 'react-i18next';
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
      const language = getI18n().language.substring(0, 2);

      for (const item of data) {
        const name = item.name as EntityValues;
        options.push({
          id: item.id as string,
          label: name[language] as string,
        });
      }

      callback(options);
    },
    cancelToken
  );
};

export default PublicEntitySelectOptions;
