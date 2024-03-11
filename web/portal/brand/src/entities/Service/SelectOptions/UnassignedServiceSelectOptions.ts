import { DropdownChoices } from '@irontec/ivoz-ui';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import { fetchAllPages } from '@irontec/ivoz-ui/helpers/fechAllPages';
import { getI18n } from 'react-i18next';
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
  const language = getI18n().language.substring(0, 2);

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
        options[item.id] = item.name[language];
      }

      callback(options);
    },
    cancelToken,
  });
};

export default UnassignedServiceSelectOptions;
