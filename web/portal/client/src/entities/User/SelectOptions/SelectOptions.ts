import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import User from '../User';

const UserSelectOptions: SelectOptionsType = ({
  callback,
  cancelToken,
}): Promise<unknown> => {
  return defaultEntityBehavior.fetchFks(
    User.path,
    ['id', 'name', 'lastname'],
    (data: any) => {
      const options: any = {};
      for (const item of data) {
        options[item.id] = `${item.name} ${item.lastname}`;
      }

      callback(options);
    },
    cancelToken
  );
};

export default UserSelectOptions;
