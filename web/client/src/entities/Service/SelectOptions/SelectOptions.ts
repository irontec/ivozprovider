import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import Service from '../Service';

const SelectOptions: SelectOptionsType = (props): Promise<unknown> => {
  const { callback, cancelToken } = props;

  return defaultEntityBehavior.fetchFks(
    Service.path,
    ['id', 'name'],
    (data: any) => {
      const options: any = {};
      for (const item of data) {
        options[item.id] = Service.toStr(item);
      }

      callback(options);
    },
    cancelToken
  );
};

export default SelectOptions;
