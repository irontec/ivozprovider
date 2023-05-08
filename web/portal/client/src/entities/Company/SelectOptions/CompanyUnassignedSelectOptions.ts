import { DropdownArrayChoices, EntityValues } from '@irontec/ivoz-ui';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
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

  const getAction = store.getActions().api.get;

  const entities = store.getState().entities.entities;
  const Company = entities.Company;

  const _includeId = customProps?._includeId;
  if (_includeId) {
    params._includeId = _includeId;
  }

  return getAction({
    path: `${Company.path}/corporate/unassigned`,
    params,
    successCallback: async (data) => {
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
