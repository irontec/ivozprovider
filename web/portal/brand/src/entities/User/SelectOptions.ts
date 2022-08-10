import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import store from 'store';

const UserSelectOptions: SelectOptionsType = ({
  callback,
  cancelToken,
}): Promise<unknown> => {
  const entities = store.getState().entities.entities;
  const User = entities.User;

  return defaultEntityBehavior.fetchFks(
    User.path,
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

export default UserSelectOptions;
