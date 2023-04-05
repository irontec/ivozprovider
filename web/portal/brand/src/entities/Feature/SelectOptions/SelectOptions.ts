import { EntityValues } from '@irontec/ivoz-ui';
import defaultEntityBehavior, {
  PropertyFkChoices,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import store from 'store';

const FeatureSelectOptions: SelectOptionsType = ({
  callback,
  cancelToken,
}): Promise<unknown> => {
  const entities = store.getState().entities.entities;
  const Feature = entities.Feature;

  return defaultEntityBehavior.fetchFks(
    Feature.path,
    ['id', 'iden', 'name'],
    (data: Array<EntityValues>) => {
      const options: PropertyFkChoices = [];

      const featuresToIgnore = [
        'billing',
        'invoices',
        'residential',
        'retail',
        'vpbx',
        'wholesale',
      ];

      for (const item of data) {
        if (featuresToIgnore.includes(item.iden as string)) {
          continue;
        }

        options.push({
          id: item.id as number,
          label: Feature.toStr(item),
          extraData: {
            iden: item.iden,
          },
        });
      }

      callback(options);
    },
    cancelToken
  );
};

export default FeatureSelectOptions;
