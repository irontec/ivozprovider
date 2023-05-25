import { DropdownChoices } from '@irontec/ivoz-ui';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import { EntityValues } from '@irontec/ivoz-ui/services/entity/EntityService';
import { PathMatch } from 'react-router-dom';
import store from 'store';

import { HuntGroupPropertyList } from '../../HuntGroup/HuntGroupProperties';

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

  const getAction = store.getActions().api.get;
  const entities = store.getState().entities.entities;
  const HuntGroup = entities.HuntGroup;

  return getAction({
    path: `${HuntGroup.path}/${id}/users_available`,
    params,
    successCallback: async (data) => {
      const options: DropdownChoices = {};
      for (const item of data as HuntGroupPropertyList<string>[]) {
        options[item.id as string] = `${item.name}`;
      }
      callback(options);
    },
    cancelToken,
  });
};

export default HuntGroupAvailableSelectOptions;
