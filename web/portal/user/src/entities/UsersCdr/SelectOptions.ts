import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import UsersCdr from './UsersCdr';

const UsersCdrSelectOptions: SelectOptionsType = ({
  callback,
  cancelToken,
}): Promise<unknown> => {
  return defaultEntityBehavior.fetchFks(
    UsersCdr.path,
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

export default UsersCdrSelectOptions;
