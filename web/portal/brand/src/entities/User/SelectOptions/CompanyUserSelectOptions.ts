import { DropdownChoices } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
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

  return defaultEntityBehavior.fetchFks(
    User.path + `?company[]=${companyId}`,
    ['id', 'name', 'lastname'],
    (data: any) => {
      const options: DropdownChoices = [];
      for (const item of data) {
        options.push({ id: item.id, label: `${item.name} ${item.lastname}` });
      }

      callback(options);
    },
    cancelToken
  );
};

export default CompanyUserSelectOptions;
