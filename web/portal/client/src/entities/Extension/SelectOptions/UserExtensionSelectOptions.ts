import { DropdownChoices } from '@irontec-voip/ivoz-ui';
import { SelectOptionsType } from '@irontec-voip/ivoz-ui/entities/EntityInterface';
import { fetchAllPages } from '@irontec-voip/ivoz-ui/helpers/fechAllPages';

import Extension from '../Extension';
import { ExtensionPropertyList } from '../ExtensionProperties';

const UserExtensionSelectOptions: SelectOptionsType = ({
  callback,
  cancelToken,
}): Promise<unknown> => {
  const params: Record<string, unknown> = {
    _properties: ['id', 'number'],
  };

  return fetchAllPages({
    endpoint: `${Extension.path}?routeType[exact]=user`,
    params,
    setter: async (data) => {
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
