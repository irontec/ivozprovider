import { DropdownChoices, fetchFilteredPage } from '@irontec/ivoz-ui';
import {
  DynamicSelectOptionsArgs,
  SelectOptionsType,
} from '@irontec/ivoz-ui/entities/EntityInterface';
import store from 'store';

const DdiSelectOptions: SelectOptionsType<DynamicSelectOptionsArgs> = (
  { callback, cancelToken },
  customProps
): Promise<unknown> => {
  const entities = store.getState().entities.entities;
  const Company = entities.Company;

  return fetchFilteredPage({
    endpoint: `${Company.path}?type[]=vpbx&type[]=retail&type[]=residential&_order[name]=ASC`,
    params: {
      _properties: ['id', 'name'],
      'name[partial]': customProps?.searchTerm ?? '',
      id: customProps?.id,
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

export default DdiSelectOptions;
