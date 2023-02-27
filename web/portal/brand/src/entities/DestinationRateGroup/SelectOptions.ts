import { DropdownChoices } from '@irontec/ivoz-ui';
import { getI18n } from 'react-i18next';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import store from 'store';
import { DestinationRateGroupPropertiesList } from './DestinationRateGroupProperties';

const DestinationRateGroupSelectOptions: SelectOptionsType = ({
  callback,
  cancelToken,
}): Promise<unknown> => {
  const entities = store.getState().entities.entities;
  const DestinationRateGroup = entities.DestinationRateGroup;
  const language = getI18n().language.substring(0, 2);

  return defaultEntityBehavior.fetchFks(
    DestinationRateGroup.path,
    ['id', 'name'],
    (data: DestinationRateGroupPropertiesList) => {
      const options: DropdownChoices = [];
      for (const item of data) {
        options.push({
          id: item.id as number,
          label:
            ((item.name as Record<string, string>)[language] as string) || '',
        });
      }

      callback(options);
    },
    cancelToken
  );
};

export default DestinationRateGroupSelectOptions;
