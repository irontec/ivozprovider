import { DropdownChoices } from '@irontec-voip/ivoz-ui';
import { SelectOptionsType } from '@irontec-voip/ivoz-ui/entities/EntityInterface';
import { fetchAllPages } from '@irontec-voip/ivoz-ui/helpers/fechAllPages';
import store from 'store';

const ResidentialSelectOptions: SelectOptionsType = ({
  callback,
  cancelToken,
}): Promise<unknown> => {
  const entities = store.getState().entities.entities;
  const Company = entities.Company;

  return fetchAllPages({
    endpoint: `${Company.path}?type=residential&_order[name]=ASC`,
    params: {
      _properties: ['id', 'name', 'company'],
    },
    setter: async (data) => {
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

export default ResidentialSelectOptions;
