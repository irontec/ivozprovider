import { DropdownChoices } from '@irontec/ivoz-ui';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import store from 'store';

import Extension from '../Extension';
import { ExtensionPropertyList } from '../ExtensionProperties';

const UserExtensionSelectOptions: SelectOptionsType = ({
  callback,
  cancelToken,
}): Promise<unknown> => {
  const params: Record<string, unknown> = {
    _properties: ['id', 'number'],
  };

  const getAction = store.getActions().api.get;

  return getAction({
    path: `${Extension.path}?routeType[exact]=user`,
    params,
    successCallback: async (data) => {
      const options: DropdownChoices = {};
      for (const item of data as ExtensionPropertyList<string>[]) {
        options[item.id as string] = item.number as string;
      }
      callback(options);
    },
    cancelToken,
  });
};

export default UserExtensionSelectOptions;
