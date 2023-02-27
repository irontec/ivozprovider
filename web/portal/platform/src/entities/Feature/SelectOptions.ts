import { DropdownChoices } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import store from 'store';
import { FeaturePropertiesList } from './FeatureProperties';

const FeatureSelectOptions: SelectOptionsType = ({
  callback,
  cancelToken,
}): Promise<unknown> => {
  const entities = store.getState().entities.entities;
  const Feature = entities.Feature;

  return defaultEntityBehavior.fetchFks(
    Feature.path,
    ['id', 'iden', 'name'],
    (data: FeaturePropertiesList) => {
      const options: DropdownChoices = [];

      for (const item of data) {
        options.push({ id: item.id as number, label: item.iden as string });
      }

      callback(options);
    },
    cancelToken
  );
};

export default FeatureSelectOptions;
