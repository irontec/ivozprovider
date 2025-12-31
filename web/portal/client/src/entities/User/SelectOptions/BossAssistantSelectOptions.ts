import { DropdownChoices, fetchAllPages } from '@irontec/ivoz-ui';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import store from 'store';

import { UserPropertyList } from '../UserProperties';

type CustomPropsType = {
  _excludeId?: number;
};

const BossAssistantSelectOptions: SelectOptionsType<CustomPropsType> = (
  { callback, cancelToken },
  customProps
): Promise<unknown> => {
  const params: Record<string, unknown> = {
    _properties: ['id', 'name', 'lastname'],
    isBoss: 0,
  };

  const _excludeId = customProps?._excludeId;
  if (_excludeId) {
    params['id[neq]'] = _excludeId;
  }

  const entities = store.getState().entities.entities;
  const User = entities.User;

  return fetchAllPages({
    endpoint: User.path,
    params,
    setter: async (data) => {
      const options: DropdownChoices = {};
      for (const item of data as UserPropertyList<string>[]) {
        options[item.id as string] = `${item.name} ${item.lastname}`;
      }
      callback(options);
    },
    cancelToken,
  });
};

export default BossAssistantSelectOptions;
