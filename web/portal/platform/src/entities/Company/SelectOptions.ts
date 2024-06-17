import { DropdownChoices } from '@irontec-voip/ivoz-ui';
import defaultEntityBehavior from '@irontec-voip/ivoz-ui/entities/DefaultEntityBehavior';
import { SelectOptionsType } from '@irontec-voip/ivoz-ui/entities/EntityInterface';
import store from 'store';

import { CompanyPropertiesList } from './CompanyProperties';

const CompanySelectOptions: SelectOptionsType = ({
  callback,
  cancelToken,
}): Promise<unknown> => {
  const entities = store.getState().entities.entities;
  const Company = entities.Company;

  return defaultEntityBehavior.fetchFks(
    `${Company.path}?_order[name]=ASC`,
    ['id', 'name', 'countryCode'],
    (data: CompanyPropertiesList) => {
      const options: DropdownChoices = [];
      for (const item of data) {
        options.push({
          id: item.id as number,
          label: item.name as string,
        });
      }

      callback(options);
    },
    cancelToken
  );
};

export default CompanySelectOptions;
