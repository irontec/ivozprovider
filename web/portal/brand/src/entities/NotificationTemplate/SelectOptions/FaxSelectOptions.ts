import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import store from 'store';

const FaxSelectOptions: SelectOptionsType = ({
  callback,
  cancelToken,
}): Promise<unknown> => {
  const entities = store.getState().entities.entities;
  const NotificationTemplate = entities.NotificationTemplate;

  return defaultEntityBehavior.fetchFks(
    `${NotificationTemplate.path}?type=fax`,
    ['id', 'name'],
    (data: any) => {
      const options: any = {};
      for (const item of data) {
        options[item.id] = NotificationTemplate.toStr(item);
      }

      callback(options);
    },
    cancelToken
  );
};

export default FaxSelectOptions;
