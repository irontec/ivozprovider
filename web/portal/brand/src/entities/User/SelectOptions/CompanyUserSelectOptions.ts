import { DropdownChoices, fetchAllPages } from '@irontec/ivoz-ui';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import store from 'store';

type CompanyDdiSelectOptionsProps = {
  companyId: number;
};

const CompanyUserSelectOptions: SelectOptionsType<
  CompanyDdiSelectOptionsProps
> = ({ callback, cancelToken }, customProps): Promise<unknown> => {
  const entities = store.getState().entities.entities;
  const User = entities.User;
  const companyId = customProps?.companyId;

  return fetchAllPages({
    endpoint: `${User.path}?company[]=${companyId}`,
    params: {
      _properties: ['id', 'name', 'lastname'],
    },
    setter: async (data) => {
      const options: DropdownChoices = [];
      for (const item of data) {
        options.push({ id: item.id, label: `${item.name} ${item.lastname}` });
      }

      callback(options);
    },
    cancelToken,
  });
};

export default CompanyUserSelectOptions;
