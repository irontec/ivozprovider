import { DropdownChoices } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import { getI18n } from 'react-i18next';
import store from 'store';

const DestinationSelectOptions: SelectOptionsType = ({
  callback,
  cancelToken,
}): Promise<unknown> => {
  const entities = store.getState().entities.entities;
  const Destination = entities.Destination;
  const language = getI18n().language.substring(0, 2);

  return defaultEntityBehavior.fetchFks(
    `${Destination.path}?_order[name.${[language]}]=ASC`,
    ['id', 'name', 'prefix'],
    (data) => {
      const options: DropdownChoices = [];
      for (const item of data) {
        options.push({
          id: item.id,
          label: `${item.name[language]} (${item.prefix})`,
        });
      }

      callback(options);
    },
    cancelToken
  );
};

export default DestinationSelectOptions;
