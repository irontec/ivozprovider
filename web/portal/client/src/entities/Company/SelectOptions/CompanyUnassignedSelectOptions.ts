import { DropdownArrayChoices, EntityValues } from '@irontec-voip/ivoz-ui';
import { SelectOptionsType } from '@irontec-voip/ivoz-ui/entities/EntityInterface';
import { fetchAllPages } from '@irontec-voip/ivoz-ui/helpers/fechAllPages';
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
