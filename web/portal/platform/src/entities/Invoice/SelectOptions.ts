import { DropdownChoices } from '@irontec-voip/ivoz-ui';
import defaultEntityBehavior from '@irontec-voip/ivoz-ui/entities/DefaultEntityBehavior';
import { SelectOptionsType } from '@irontec-voip/ivoz-ui/entities/EntityInterface';
import store from 'store';

import { InvoicePropertiesList } from './InvoiceProperties';

const InvoiceSelectOptions: SelectOptionsType = ({
  callback,
  cancelToken,
}): Promise<unknown> => {
  const entities = store.getState().entities.entities;
  const Invoice = entities.Invoice;

  return defaultEntityBehavior.fetchFks(
    Invoice.path,
    ['id', 'number'],
    (data: InvoicePropertiesList) => {
      const options: DropdownChoices = [];

      for (const item of data) {
        options.push({
          id: item.id as number,
          label: Invoice.toStr(item),
        });
      }

      callback(options);
    },
    cancelToken
  );
};

export default InvoiceSelectOptions;
