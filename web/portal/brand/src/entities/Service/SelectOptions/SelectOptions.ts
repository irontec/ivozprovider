import { DropdownChoices } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import store from 'store';
import { getI18n } from 'react-i18next';

const ServiceSelectOptions: SelectOptionsType = ({
  callback,
  cancelToken,
}): Promise<unknown> => {
  const entities = store.getState().entities.entities;
  const Service = entities.Service;
  const language = getI18n().language.substring(0, 2);

  return defaultEntityBehavior.fetchFks(
    Service.path + `?_order[name.${[language]}]=ASC`,
    ['id', 'name'],
    (data: any) => {
      const options: DropdownChoices = [];
      for (const item of data) {
        options.push({ id: item.id, label: item.name[language] });
      }

      callback(options);
    },
    cancelToken
  );
};

export default ServiceSelectOptions;
