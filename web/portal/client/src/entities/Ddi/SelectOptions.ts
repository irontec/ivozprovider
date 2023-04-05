import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import store from 'store';

const DdiSelectOptions: SelectOptionsType = ({
  callback,
  cancelToken,
}): Promise<unknown> => {
  const entities = store.getState().entities.entities;
  const Ddi = entities.Ddi;

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
    cancelToken
  );
};

export default DdiSelectOptions;
