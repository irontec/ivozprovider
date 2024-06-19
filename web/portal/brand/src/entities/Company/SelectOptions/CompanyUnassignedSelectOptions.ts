import { DropdownArrayChoices, EntityValues } from '@irontec/ivoz-ui';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import { fetchAllPages } from '@irontec/ivoz-ui/helpers/fechAllPages';
import store from 'store';

type CompanySelectOptionsArgs = {
  _includeId: number;
};

const UnassignedCompanySelectOptions: SelectOptionsType<
  CompanySelectOptionsArgs
> = (props, customProps): Promise<unknown> => {
  const { callback, cancelToken } = props;
  const params: EntityValues = {
    _properties: ['id', 'name'],
  };

  const entities = store.getState().entities.entities;
  const Company = entities.Company;

  const _includeId = customProps?._includeId;
  if (_includeId) {
    params._includeId = _includeId;
  }

  const _companyId = props?.companyId;
  if (_companyId) {
    params._companyId = _companyId;
  }

  return fetchAllPages({
    endpoint: `${Company.path}/corporate/unassigned`,
    params,
    setter: async (data) => {
      const options: DropdownArrayChoices = [];
      for (const item of data as Record<string, string>[]) {
        options.push({ id: item.id, label: item.name });
      }
      callback(options);
    },
    cancelToken,
  });
};

export default UnassignedCompanySelectOptions;
