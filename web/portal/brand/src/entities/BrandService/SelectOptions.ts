import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import store from 'store';

const BrandServiceSelectOptions: SelectOptionsType = ({ callback, cancelToken }): Promise<unknown> => {

  const entities = store.getState().entities.entities;
  const BrandService = entities.BrandService;

  return defaultEntityBehavior.fetchFks(
    BrandService.path,
    ['id'],
    (data: any) => {

      const options: any = {};
      for (const item of data) {
        options[item.id] = item.id;
      }

      callback(options);
    },
    cancelToken,
  );
};

export default BrandServiceSelectOptions;