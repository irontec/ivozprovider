import { DropdownChoices } from '@irontec/ivoz-ui';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import store from 'store';

import Extension from '../Extension';
import { ExtensionPropertyList } from '../ExtensionProperties';

type CustomPropsType = {
  _includeId: number;
};

const UnassignedExtensionSelectOptions: SelectOptionsType<CustomPropsType> = (
  { callback, cancelToken },
  customProps
): Promise<unknown> => {
  const params: Record<string, unknown> = {
    _properties: ['id', 'number'],
  };
  const _includeId = customProps?._includeId;
  if (_includeId) {
    params._includeId = _includeId;
  }

  const getAction = store.getActions().api.get;

  return getAction({
    path: `${Extension.path}/unassigned`,
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

export default UnassignedExtensionSelectOptions;
