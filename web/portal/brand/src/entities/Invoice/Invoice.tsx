import ReceiptIcon from '@mui/icons-material/Receipt';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';
import Form from './Form';
import { foreignKeyGetter } from './ForeignKeyGetter';
import { InvoiceProperties } from './InvoiceProperties';
import foreignKeyResolver from './ForeignKeyResolver';
import Total from './Field/Total';
import TotalWithTax from './Field/TotalWithTax';

const properties: InvoiceProperties = {
  number: {
    label: _('Number'),
    maxLength: 30,
    required: true,
  },
  inDate: {
    label: _('In date'),
    format: 'date',
    required: true,
  },
  outDate: {
    label: _('Out date'),
    format: 'date',
    required: true,
  },
  total: {
    label: _('Total'),
    component: Total,
  },
  taxRate: {
    label: _('Tax rate'),
    subfix: '%',
    required: true,
  },
  totalWithTax: {
    label: _('Total with tax'),
    component: TotalWithTax,
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
    readOnly: true,
  },
  statusMsg: {
    label: _('Status Msg'),
  },
  pdf: {
    label: _('Pdf file'),
    type: 'file',
    readOnly: true,
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
    label: _('Invoice number sequence', { count: 1 }),
    null: _('Unassigned'),
    default: '__null__',
    visualToggle: {
      __default__: {
        show: [],
        hide: ['number'],
      },
      __null__: {
        show: ['number'],
        hide: [],
      },
    },
  },
  scheduler: {
    label: _('Invoice Scheduler', { count: 1 }),
    null: _('Unassigned'),
  },
};

const Invoice: EntityInterface = {
  ...defaultEntityBehavior,
  icon: ReceiptIcon,
  iden: 'Invoice',
  title: _('Invoice', { count: 2 }),
  path: '/invoices',
  toStr: (row: any) => row.number,
  properties,
  columns: [
    'company',
    'number',
    'inDate',
    'outDate',
    'total',
    'taxRate',
    'totalWithTax',
    'status',
    'invoiceTemplate',
    'pdf',
  ],
  selectOptions,
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default Invoice;
