import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import store from 'store';

type CompanyDdiSelectOptionsProps = {
  companyId: number;
};

const CompanyDdiSelectOptions: SelectOptionsType<
  CompanyDdiSelectOptionsProps
> = ({ callback, cancelToken }, customProps): Promise<unknown> => {
  const entities = store.getState().entities.entities;
  const Ddi = entities.Ddi;
  const companyId = customProps?.companyId;

  return defaultEntityBehavior.fetchFks(
    Ddi.path + `?company[]=${companyId}`,
    ['id', 'ddie164'],
    (data: any) => {
      const options: any = {};
      for (const item of data) {
        options[item.id] = Ddi.toStr(item);
      }

      callback(options);
    },
    cancelToken
  );
};

export default CompanyDdiSelectOptions;
