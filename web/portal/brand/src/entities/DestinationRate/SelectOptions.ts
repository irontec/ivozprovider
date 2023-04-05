import { DropdownChoices } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import store from 'store';
import { DestinationRatePropertiesList } from './DestinationRateProperties';

const DestinationRateSelectOptions: SelectOptionsType = ({
  callback,
  cancelToken,
}): Promise<unknown> => {
  const entities = store.getState().entities.entities;
  const DestinationRate = entities.DestinationRate;

  return defaultEntityBehavior.fetchFks(
    DestinationRate.path,
    ['id'],
    (data: DestinationRatePropertiesList) => {
      const options: DropdownChoices = [];
      for (const item of data) {
        options.push({
          id: item.id as number,
          label: `${item.id}`,
        });
      }

      callback(options);
    },
    cancelToken
  );
};

export default DestinationRateSelectOptions;
