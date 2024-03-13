import { DropdownArrayChoices } from '@irontec/ivoz-ui';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import { fetchAllPages } from '@irontec/ivoz-ui/helpers/fechAllPages';
import store from 'store';

import { CorporationPropertiesList } from '../../Corporation/CorporationProperties';

const CorporationSelectOptions: SelectOptionsType = ({
  callback,
  cancelToken,
}): Promise<unknown> => {
  const entities = store.getState().entities.entities;
  const Corporation = entities.Corporation;

  return fetchAllPages({
    endpoint: Corporation.path,
    params: {
      _properties: ['id', 'name'],
    },
    setter: async (data: CorporationPropertiesList) => {
      const options: DropdownArrayChoices = [];
      for (const item of data) {
        options.push({
          id: item.id as number,
          label: item.name as string,
        });
      }

      callback(options);
    },
    cancelToken,
  });
};

export default CorporationSelectOptions;
