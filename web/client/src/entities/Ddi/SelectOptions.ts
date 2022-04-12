import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import Ddi from './Ddi';

const DdiSelectOptions: SelectOptionsType = ({ callback, cancelToken }): Promise<unknown> => {

  return defaultEntityBehavior.fetchFks(
    Ddi.path,
    ['id', 'ddie164'],
    (data: any) => {

      const options: any = {};
      for (const item of data) {
        options[item.id] = item.ddie164;
      }

      callback(options);
    },
    cancelToken,
  );
};

export default DdiSelectOptions;