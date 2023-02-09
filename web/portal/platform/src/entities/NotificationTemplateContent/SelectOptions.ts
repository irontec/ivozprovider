import { DropdownChoices } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import store from 'store';
import { NotificationTemplateContentPropertiesList } from './NotificationTemplateContentProperties';

const InvoiceTemplateSelectOptions: SelectOptionsType = ({
  callback,
  cancelToken,
}): Promise<unknown> => {
  const entities = store.getState().entities.entities;
  const InvoiceTemplate = entities.InvoiceTemplate;

  return defaultEntityBehavior.fetchFks(
    InvoiceTemplate.path,
    ['id', 'name'],
    (data: NotificationTemplateContentPropertiesList) => {
      const options: DropdownChoices = [];
      for (const item of data) {
        options.push({ id: item.id as string, label: item.fromName as string });
      }

      callback(options);
    },
    cancelToken
  );
};

export default InvoiceTemplateSelectOptions;
