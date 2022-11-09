import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import store from 'store';

const OutgoingDdiRuleSelectOptions: SelectOptionsType = ({
  callback,
  cancelToken,
}): Promise<unknown> => {
  const entities = store.getState().entities.entities;
  const OutgoingDdiRule = entities.OutgoingDdiRule;

  return defaultEntityBehavior.fetchFks(
    OutgoingDdiRule.path,
    ['id', 'name'],
    (data: any) => {
      const options: any = {};
      for (const item of data) {
        options[item.id] = OutgoingDdiRule.toStr(item);
      }

      callback(options);
    },
    cancelToken
  );
};

export default OutgoingDdiRuleSelectOptions;
