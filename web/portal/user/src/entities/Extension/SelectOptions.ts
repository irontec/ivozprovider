import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import extension from './Extension';

const selectOptions: SelectOptionsType = ({
  callback,
  cancelToken,
}): Promise<unknown> => {
  return defaultEntityBehavior.fetchFks(
    extension.path,
    ['id', 'number'],
    (data: any) => {
      const options: any = {};
      for (const item of data) {
        options[item.id] = item.number;
      }

      callback(options);
    },
    cancelToken
  );
};

export default selectOptions;
