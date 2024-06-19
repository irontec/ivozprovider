import { DropdownChoices, EntityValues } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import { getI18n } from 'react-i18next';
import store from 'store';

const ServiceSelectOptions: SelectOptionsType = ({
  callback,
  cancelToken,
}): Promise<unknown> => {
  const entities = store.getState().entities.entities;
  const Service = entities.Service;
  const language = getI18n().language.substring(0, 2);

  return defaultEntityBehavior.fetchFks(
    `${Service.path}?_order[name.${[language]}]=ASC`,
    ['id', 'name'],
    (data: Array<EntityValues>) => {
      const options: DropdownChoices = [];
      for (const item of data) {
        options.push({
          id: item.id as number,
          label: (item.name as Record<string, string>)?.[language] || '',
        });
      }

      callback(options);
    },
    cancelToken
  );
};

export default ServiceSelectOptions;
