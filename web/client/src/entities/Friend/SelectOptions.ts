import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import Friend from './Friend';

const FriendSelectOptions: SelectOptionsType = ({ callback, cancelToken }): Promise<unknown> => {

  return defaultEntityBehavior.fetchFks(
    Friend.path,
    ['id', 'name'],
    (data: any) => {
      const options: any = {};
      for (const item of data) {
        options[item.id] = item.name;
      }

      callback(options);
    },
    cancelToken,
  );
};

export default FriendSelectOptions;