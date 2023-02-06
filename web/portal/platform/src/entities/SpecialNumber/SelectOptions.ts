import { DropdownChoices, EntityValues } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import store from 'store';

const GlobalSpecialNumberSelectOptions: SelectOptionsType = ({
  callback,
  cancelToken,
}): Promise<unknown> => {
  const entities = store.getState().entities.entities;
  const GlobalSpecialNumber = entities.GlobalSpecialNumber;

  return defaultEntityBehavior.fetchFks(
    GlobalSpecialNumber.path,
    ['id', 'number'],
    (data: Array<EntityValues>) => {
      const options: DropdownChoices = [];
      for (const item of data) {
        options.push({ id: item.id as string, label: item.number as string });
      }

      callback(options);
    },
    cancelToken
  );
};

export default GlobalSpecialNumberSelectOptions;
