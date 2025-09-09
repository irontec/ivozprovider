import { EntityValues } from '@irontec/ivoz-ui';
import defaultEntityBehavior, {
  marshaller as defaultMarshaller,
  unmarshaller as defaultUnmarshaller,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface, {
  OrderDirection,
} from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import ReceiptIcon from '@mui/icons-material/Receipt';

import Actions from './Action';
import Total from './Field/Total';
import TotalWithTax from './Field/TotalWithTax';
import { InvoiceProperties, InvoicePropertyList } from './InvoiceProperties';

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
    readOnly: true,
  },
  taxRate: {
    label: _('Tax rate'),
    suffix: '%',
    required: true,
  },
  totalWithTax: {
    label: _('Total with tax'),
    component: TotalWithTax,
    readOnly: true,
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
    label: _('PDF file'),
    type: 'file',
    readOnly: true,
    downloadable: true,
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

type MarshallerType = typeof defaultMarshaller;
const marshaller: MarshallerType = (values, properties) => {
  delete values.total;
  delete values.totalWithTax;

  return defaultMarshaller(values, properties);
};

type UnmarshallerType = typeof defaultUnmarshaller;
const unmarshaller: UnmarshallerType = (row, properties) => {
  const values = { ...row };
  values.inDate = values.inDate.substring(0, 'yyyy-mm-dd'.length);
  values.outDate = values.outDate.substring(0, 'yyyy-mm-dd'.length);

  return defaultUnmarshaller(values, properties);
};

const Invoice: EntityInterface = {
  ...defaultEntityBehavior,
  icon: ReceiptIcon,
  link: '/doc/${language}/administration_portal/brand/invoicing/invoices.html',
  iden: 'Invoice',
  title: _('Invoice', { count: 2 }),
  path: '/invoices',
  defaultOrderBy: '',
  defaultOrderDirection: OrderDirection.desc,
  toStr: (row: InvoicePropertyList<EntityValues>) => `${row.number}`,
  properties,
  columns: [
    'company',
    'number',
    'inDate',
    'outDate',
    'totalWithTax',
    'status',
    'invoiceTemplate',
    'pdf',
  ],
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'Invoices',
  },
  customActions: Actions,
  selectOptions: async () => {
    const module = await import('./SelectOptions');

    return module.default;
  },
  foreignKeyResolver: async () => {
    const module = await import('./ForeignKeyResolver');

    return module.default;
  },
  foreignKeyGetter: async () => {
    const module = await import('./ForeignKeyGetter');

    return module.foreignKeyGetter;
  },
  Form: async () => {
    const module = await import('./Form');

    return module.default;
  },
  marshaller,
  unmarshaller,
};

export default Invoice;
