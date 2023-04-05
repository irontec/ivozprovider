import ReceiptIcon from '@mui/icons-material/Receipt';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { InvoiceProperties } from './InvoiceProperties';
import { EntityValues } from '@irontec/ivoz-ui/services/entity/EntityService';

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
    label: _('Pdf file'),
    type: 'file',
  },
};

const Invoice: EntityInterface = {
  ...defaultEntityBehavior,
  icon: ReceiptIcon,
  iden: 'Invoice',
  title: _('Invoice', { count: 2 }),
  path: '/invoices',
  properties,
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'Invoices',
  },
  toStr: (row: EntityValues) => row.number as string,
};

export default Invoice;
