import { DropdownChoices } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import store from 'store';

import { NotificationTemplateContentPropertiesList } from './NotificationTemplateContentProperties';

const NotificationTemplateContentSelectOptions: SelectOptionsType = ({
  callback,
  cancelToken,
}): Promise<unknown> => {
  const entities = store.getState().entities.entities;
  const NotificationTemplateContent = entities.NotificationTemplateContent;

  return defaultEntityBehavior.fetchFks(
    `${NotificationTemplateContent.path}?_order[fromName]=ASC`,
    ['id', 'fromName'],
    (data: NotificationTemplateContentPropertiesList) => {
      const options: DropdownChoices = [];
      for (const item of data) {
        options.push({ id: item.id as number, label: item.fromName as string });
      }

      callback(options);
    },
    cancelToken
  );
};

export default NotificationTemplateContentSelectOptions;
