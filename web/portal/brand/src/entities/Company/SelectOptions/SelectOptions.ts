import { DropdownChoices } from '@irontec/ivoz-ui';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import store from 'store';

const CompanySelectOptions: SelectOptionsType = ({
  callback,
  cancelToken,
}): Promise<unknown> => {
  const entities = store.getState().entities.entities;
  const Company = entities.Company;
  const getAction = store.getActions().api.get;

  return getAction({
    path: `${Company.path}?_order[name]=ASC`,
    params: {
      _pagination: false,
      _itemsPerPage: 5000,
      _properties: ['id', 'name'],
    },
    successCallback: async (data) => {
      const options: DropdownChoices = [];
      for (const item of data) {
        options.push({
          id: item.id,
          label: item.name,
        });
      }
      callback(options);
    },
    cancelToken,
  });
};

export default CompanySelectOptions;
