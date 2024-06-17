import { DropdownChoices } from '@irontec-voip/ivoz-ui';
import { SelectOptionsType } from '@irontec-voip/ivoz-ui/entities/EntityInterface';
import { fetchAllPages } from '@irontec-voip/ivoz-ui/helpers/fechAllPages';
import store from 'store';

type ServiceSelectOptionsArgs = {
  includeId?: number;
};

const UnassignedServiceSelectOptions: SelectOptionsType<
  ServiceSelectOptionsArgs
> = (props, customProps = {}): Promise<unknown> => {
  const { callback, cancelToken } = props;
  const { includeId } = customProps;

  const entities = store.getState().entities.entities;
  const Service = entities.Service;

  let path = `${Service.path}/unassigned`;
  if (includeId) {
    path += `?_includeId=${includeId}`;
  }

  return fetchAllPages({
    endpoint: path,
    params: {
      _properties: ['id', 'name'],
    },
    setter: async (data) => {
      const options: DropdownChoices = {};
      for (const item of data) {
        options[item.id] = Service.toStr(item);
      }

      callback(options);
    },
    cancelToken,
  });
};

export default UnassignedServiceSelectOptions;
