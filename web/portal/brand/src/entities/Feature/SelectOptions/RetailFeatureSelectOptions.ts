import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import store from 'store';

const RetailFeatureSelectOptions: SelectOptionsType = ({
  callback,
  cancelToken,
}): Promise<unknown> => {
  const entities = store.getState().entities.entities;
  const Feature = entities.Feature;

  return defaultEntityBehavior.fetchFks(
    Feature.path,
    ['id', 'iden', 'name'],
    (data: any) => {
      const options: any = {};

      const featuresToIgnore = [
        'queues',
        'friends',
        'conferences',
        'billing',
        'invoices',
        'residential',
        'retail',
        'vpbx',
        'wholesale',
      ];

      for (const item of data) {
        if (featuresToIgnore.includes(item.iden)) {
          continue;
        }

        options[item.id] = Feature.toStr(item);
      }

      callback(options);
    },
    cancelToken
  );
};

export default RetailFeatureSelectOptions;
