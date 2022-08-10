import AccountTreeIcon from '@mui/icons-material/AccountTree';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';
import Form from './Form';
import { foreignKeyGetter } from './ForeignKeyGetter';
import { InvoiceProperties } from './InvoiceProperties';
import foreignKeyResolver from './ForeignKeyResolver';

const properties: InvoiceProperties = {
  number: {
    label: _('Number'),
    maxLength: 30,
  },
  inDate: {
    label: _('In date'),
    format: 'date',
  },
  outDate: {
    label: _('Out date'),
    format: 'date',
  },
  total: {
    label: _('Total'),
    //@TODO IvozProvider_Klear_Ghost_Invoice::getTotal
  },
  taxRate: {
    label: _('Tax rate'),
    //@TODO sufix: "%"
  },
  totalWithTax: {
    label: _('Total with tax'),
    //@TODO IvozProvider_Klear_Ghost_Invoice::getTotalWithTax
  },
  status: {
    label: _('Status'),
    //@TODO IvozProvider_Klear_Ghost_Invoice::getStatus
    enum: {
      waiting: _('Waiting'),
      processing: _('Processing'),
      created: _('Created'),
      error: _('Error'),
    },
  },
  statusMsg: {
    label: _('Status Msg'),
  },
  pdf: {
    label: _('Pdf file'),
    //@TODO file preview
  },
  invoiceTemplate: {
    label: _('Template'),
    null: _('Unassigned'),
  },
  company: {
    label: _('Client'),
    null: _('Unassigned'),
  },
  numberSequence: {
    label: _('Invoice number sequence'),
    null: _('Unassigned'),
    //@TODO visualToggle
  },
  scheduler: {
    label: _('Invoice scheduler'),
    null: _('Unassigned'),
  },
};

const Invoice: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AccountTreeIcon,
  iden: 'Invoice',
  title: _('Invoice', { count: 2 }),
  path: '/Invoices',
  toStr: (row: any) => row.id,
  properties,
  selectOptions,
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default Invoice;
