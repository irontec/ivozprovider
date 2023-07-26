import { DropdownChoices } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import store from 'store';

const InvoiceSelectOptions: SelectOptionsType = ({
  callback,
  cancelToken,
}): Promise<unknown> => {
  const entities = store.getState().entities.entities;
  const Invoice = entities.Invoice;

  return defaultEntityBehavior.fetchFks(
    Invoice.path,
    ['id', 'number'],
    (data) => {
      const options: DropdownChoices = {};
      for (const item of data) {
        options[item.id] = item.number;
      }

      callback(options);
    },
    cancelToken
  );
};

export default InvoiceSelectOptions;
