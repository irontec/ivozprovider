import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface, {
  OrderDirection,
} from '@irontec/ivoz-ui/entities/EntityInterface';
import { EntityValues } from '@irontec/ivoz-ui/services/entity/EntityService';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import ReceiptIcon from '@mui/icons-material/Receipt';

import { InvoiceProperties } from './InvoiceProperties';

const properties: InvoiceProperties = {
  number: {
    label: _('Number'),
  },
  inDate: {
    label: _('In date'),
    type: 'string',
    format: 'date',
  },
  outDate: {
    label: _('Out date'),
    type: 'string',
    format: 'date',
  },
  totalWithTax: {
    label: _('Total with tax'),
  },
  pdf: {
    label: _('PDF File'),
    type: 'file',
    downloadable: true,
  },
};

const Invoice: EntityInterface = {
  ...defaultEntityBehavior,
  icon: ReceiptIcon,
  iden: 'Invoice',
  title: _('Invoice', { count: 2 }),
  path: '/invoices',
  properties,
  defaultOrderBy: 'inDate',
  defaultOrderDirection: OrderDirection.desc,
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'Invoices',
  },
  toStr: (row: EntityValues) => row.number as string,
};

export default Invoice;
