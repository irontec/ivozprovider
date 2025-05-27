import { DropdownChoices } from '@irontec/ivoz-ui';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import { fetchAllPages } from '@irontec/ivoz-ui/helpers/fechAllPages';

import store from '../../../store';

type CompanyLocationSelectOptionsProps = {
  companyId: number;
};

const CompanyLocationSelectOptions: SelectOptionsType<
  CompanyLocationSelectOptionsProps | undefined
> = ({ callback, cancelToken }, customProps): Promise<unknown> => {
  const entities = store.getState().entities.entities;
  const Location = entities.Location;
  const companyId = customProps?.companyId;

  return fetchAllPages({
    endpoint: `${Location.path}?company[]=${companyId}`,
    params: {
      _properties: ['id', 'name'],
    },
    setter: async (data) => {
      const options: DropdownChoices = [];
      for (const item of data) {
        options.push({ id: item.id, label: item.name });
      }

      callback(options);
    },
    cancelToken,
  });
};

export default CompanyLocationSelectOptions;
