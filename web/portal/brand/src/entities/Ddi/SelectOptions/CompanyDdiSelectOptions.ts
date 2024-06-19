import { DropdownChoices } from '@irontec/ivoz-ui';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import { fetchAllPages } from '@irontec/ivoz-ui/helpers/fechAllPages';
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

  return fetchAllPages({
    endpoint: `${Ddi.path}?company[]=${companyId}`,
    params: {
      _properties: ['id', 'ddie164'],
    },
    setter: async (data) => {
      const options: DropdownChoices = {};
      for (const item of data) {
        options[item.id] = Ddi.toStr(item);
      }

      callback(options);
    },
    cancelToken,
  });
};

export default CompanyDdiSelectOptions;
