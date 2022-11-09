import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import { getI18n } from 'react-i18next';
import store from 'store';

const PublicEntitySelectOptions: SelectOptionsType = ({
  callback,
  cancelToken,
}): Promise<unknown> => {
  const entities = store.getState().entities.entities;
  const PublicEntity = entities.PublicEntity;

  return defaultEntityBehavior.fetchFks(
    PublicEntity.path,
    ['id', 'name'],
    (data: any) => {
      const options: any = {};
      const language = getI18n().language.substring(0, 2);

      for (const item of data) {
        options[item.id] = item.name[language];
      }

      callback(options);
    },
    cancelToken
  );
};

export default PublicEntitySelectOptions;
