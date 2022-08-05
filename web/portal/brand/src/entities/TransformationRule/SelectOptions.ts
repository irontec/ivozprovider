import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import store from 'store';

const TransformationRuleSelectOptions: SelectOptionsType = ({ callback, cancelToken }): Promise<unknown> => {

  const entities = store.getState().entities.entities;
  const TransformationRule = entities.TransformationRule;

  return defaultEntityBehavior.fetchFks(
    TransformationRule.path,
    ['id'],
    (data: any) => {

      const options: any = {};
      for (const item of data) {
        options[item.id] = item.id;
      }

      callback(options);
    },
    cancelToken,
  );
};

export default TransformationRuleSelectOptions;