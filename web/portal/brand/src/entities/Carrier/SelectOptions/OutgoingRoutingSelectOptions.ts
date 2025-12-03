import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import store from 'store';

const OutgoingRoutingSelectOptions: SelectOptionsType = ({
  callback,
  cancelToken,
}): Promise<unknown> => {
  const entities = store.getState().entities.entities;
  const Carrier = entities.Carrier;

  return defaultEntityBehavior.fetchFks(
    `${Carrier.path}?_order[name]=ASC`,
    ['id', 'name', 'hasServers', 'calculateCost'],
    (data) => {
      callback(data);
    },
    cancelToken
  );
};

export default OutgoingRoutingSelectOptions;
