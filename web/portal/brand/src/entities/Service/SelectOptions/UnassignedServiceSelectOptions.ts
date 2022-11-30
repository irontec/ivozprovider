import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import store from 'store';
import { getI18n } from 'react-i18next';

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

  return defaultEntityBehavior.fetchFks(
    path,
    ['id', 'name'],
    (data: any) => {
      const options: any = {};
      for (const item of data) {
        options[item.id] = item.name[language];
      }

      callback(options);
    },
    cancelToken
  );
};

export default UnassignedServiceSelectOptions;
