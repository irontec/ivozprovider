import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import store from 'store';

const OutgoingRoutingSelectOptions: SelectOptionsType = ({
  callback,
  cancelToken,
}): Promise<unknown> => {
  const entities = store.getState().entities.entities;
  const OutgoingRouting = entities.OutgoingRouting;

  return defaultEntityBehavior.fetchFks(
    OutgoingRouting.path,
    ['id'],
    (data: any) => {
      const options: any = {};
      for (const item of data) {
        options[item.id] = item.id;
      }

      callback(options);
    },
    cancelToken
  );
};

export default OutgoingRoutingSelectOptions;
