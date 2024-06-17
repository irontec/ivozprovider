import { DropdownChoices } from '@irontec-voip/ivoz-ui';
import { SelectOptionsType } from '@irontec-voip/ivoz-ui/entities/EntityInterface';
import { fetchAllPages } from '@irontec-voip/ivoz-ui/helpers/fechAllPages';
import store from 'store';

type CompanyDdiSelectOptionsProps = {
  companyId: number;
};

const CompanyRetailAccountSelectOptions: SelectOptionsType<
  CompanyDdiSelectOptionsProps
> = ({ callback, cancelToken }, customProps): Promise<unknown> => {
  const entities = store.getState().entities.entities;
  const RetailAccount = entities.RetailAccount;
  const companyId = customProps?.companyId;

  return fetchAllPages({
    endpoint: `${RetailAccount.path}?company[]=${companyId}`,
    params: {
      _properties: ['id', 'name'],
    },
    setter: async (data) => {
      const options: DropdownChoices = {};
      for (const item of data) {
        options[item.id] = item.name;
      }

      callback(options);
    },
    cancelToken,
  });
};

export default CompanyRetailAccountSelectOptions;
