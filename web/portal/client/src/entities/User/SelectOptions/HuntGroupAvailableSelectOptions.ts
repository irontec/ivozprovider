import { DropdownChoices, fetchAllPages } from '@irontec/ivoz-ui';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import { EntityValues } from '@irontec/ivoz-ui/services/entity/EntityService';
import { PathMatch } from 'react-router-dom';
import store from 'store';

import { UserPropertyList } from '../UserProperties';

interface CustomArgs {
  row?: EntityValues;
  match: PathMatch;
}

const HuntGroupAvailableSelectOptions: SelectOptionsType<CustomArgs> = (
  { callback, cancelToken },
  customArgs
): Promise<unknown> => {
  const match = customArgs?.match as PathMatch;
  const id = (match?.params as Record<string, string>)?.parent_id_1;

  const params: Record<string, unknown> = {
    _properties: ['id', 'name', 'lastname'],
  };

  const includeId = (customArgs?.row?.user as EntityValues)?.id as
    | number
    | undefined;

  if (includeId) {
    params._includeId = includeId;
  }

  const entities = store.getState().entities.entities;
  const HuntGroup = entities.HuntGroup;

  return fetchAllPages({
    endpoint: `${HuntGroup.path}/${id}/users_available`,
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

export default HuntGroupAvailableSelectOptions;
