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
  'number': {
    label: _('Number'),
  },
  'inDate': {
    label: _('In Date'),
  },
  'outDate': {
    label: _('Out Date'),
  },
  'total': {
    label: _('Total'),
  },
  'taxRate': {
    label: _('Tax Rate'),
  },
  'totalWithTax': {
    label: _('Total WithTax'),
  },
  'status': {
    label: _('Status'),
    enum: {
      'waiting' : _('Waiting'),
      'processing' : _('Processing'),
      'created' : _('Created'),
      'error' : _('Error'),
    },
  },
  'statusMsg': {
    label: _('Status Msg'),
  },
  'id': {
    label: _('Id'),
  },
  'pdf': {
    label: _('Pdf'),
  },
  'invoiceTemplate': {
    label: _('Invoice Template'),
  },
  'company': {
    label: _('Company'),
  },
  'numberSequence': {
    label: _('Number Sequence'),
  },
  'scheduler': {
    label: _('Scheduler'),
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
  selectOptions: (props, customProps) => { return selectOptions(props, customProps); },
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default Invoice;