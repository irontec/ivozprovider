import { DropdownChoices } from '@irontec/ivoz-ui';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import store from 'store';

import { TerminalPropertyList } from '../TerminalProperties';

type CustomPropsType = {
  _includeId: number;
};

const UnassignedTerminalSelectOptions: SelectOptionsType<CustomPropsType> = (
  { callback, cancelToken },
  customProps
): Promise<unknown> => {
  const params: Record<string, unknown> = {
    _properties: ['id', 'name'],
  };
  const _includeId = customProps?._includeId;
  if (_includeId) {
    params._includeId = _includeId;
  }

  const getAction = store.getActions().api.get;

  const entities = store.getState().entities.entities;
  const Terminal = entities.Terminal;

  return getAction({
    path: `${Terminal.path}/unassigned`,
    params,
    successCallback: async (data) => {
      const options: DropdownChoices = {};
      for (const item of data as TerminalPropertyList<string>[]) {
        const key = item.id as string;
        options[key] = item.name as string;
      }
      callback(options);
    },
    cancelToken,
  });
};

export default UnassignedTerminalSelectOptions;
