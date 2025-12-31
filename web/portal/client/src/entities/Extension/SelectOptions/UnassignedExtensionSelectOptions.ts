import { DropdownChoices, fetchAllPages } from '@irontec/ivoz-ui';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';

import Extension from '../Extension';
import { ExtensionPropertyList } from '../ExtensionProperties';

type CustomPropsType = {
  _includeId: number;
  _userId: number;
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

  const _userId = customProps?._userId;

  if (_userId) {
    params._userId = _userId;
  }

  return fetchAllPages({
    endpoint: `${Extension.path}/unassigned`,
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

export default UnassignedExtensionSelectOptions;
