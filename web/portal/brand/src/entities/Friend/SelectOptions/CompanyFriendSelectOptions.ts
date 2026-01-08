import { DropdownChoices, fetchAllPages } from '@irontec/ivoz-ui';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import store from 'store';

type CompanyDdiSelectOptionsProps = {
  companyId: number;
};

const CompanyFriendSelectOptions: SelectOptionsType<
  CompanyDdiSelectOptionsProps
> = ({ callback, cancelToken }, customProps): Promise<unknown> => {
  const entities = store.getState().entities.entities;
  const Friend = entities.Friend;
  const _companyId = customProps?.companyId;

  return fetchAllPages({
    endpoint: `${Friend.path}?company[]=${_companyId}`,
    params: {
      _properties: ['id', 'name', 'lastname'],
    },
    setter: async (data) => {
      const options: DropdownChoices = {};
      for (const item of data) {
        options[item.id] = item.name;
      }

      callback(options);
    },
    cancelToken,
  });
};

export default CompanyFriendSelectOptions;
