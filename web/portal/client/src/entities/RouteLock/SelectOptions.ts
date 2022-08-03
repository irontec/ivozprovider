import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import store from 'store';

const RouteLockSelectOptions: SelectOptionsType = ({
  callback,
  cancelToken,
}): Promise<unknown> => {
  const entities = store.getState().entities.entities;
  const RouteLock = entities.RouteLock;

  return defaultEntityBehavior.fetchFks(
    RouteLock.path,
    ['id', 'name'],
    (data: any) => {
      const options: any = {};
      for (const item of data) {
        options[item.id] = item.name;
      }

      callback(options);
    },
    cancelToken
  );
};

export default RouteLockSelectOptions;
