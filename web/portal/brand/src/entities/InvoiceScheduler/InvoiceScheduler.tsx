import AccountTreeIcon from '@mui/icons-material/AccountTree';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';
import Form from './Form';
import { foreignKeyGetter } from './ForeignKeyGetter';
import { InvoiceSchedulerProperties } from './InvoiceSchedulerProperties';
import foreignKeyResolver from './ForeignKeyResolver';

const properties: InvoiceSchedulerProperties = {
  'name': {
    label: _('Name'),
  },
  'unit': {
    label: _('Unit'),
    enum: {
      'week' : _('Week'),
      'month' : _('Month'),
      'year' : _('Year'),
    },
  },
  'frequency': {
    label: _('Frequency'),
  },
  'email': {
    label: _('Email'),
  },
  'lastExecution': {
    label: _('Last Execution'),
  },
  'lastExecutionError': {
    label: _('Last ExecutionError'),
  },
  'nextExecution': {
    label: _('Next Execution'),
  },
  'taxRate': {
    label: _('Tax Rate'),
  },
  'id': {
    label: _('Id'),
  },
  'invoiceTemplate': {
    label: _('Invoice Template'),
  },
  'brand': {
    label: _('Brand'),
  },
  'company': {
    label: _('Company'),
  },
  'numberSequence': {
    label: _('Number Sequence'),
  },
};

const InvoiceScheduler: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AccountTreeIcon,
  iden: 'InvoiceScheduler',
  title: _('InvoiceScheduler', { count: 2 }),
  path: '/InvoiceSchedulers',
  toStr: (row: any) => row.id,
  properties,
  selectOptions: (props, customProps) => { return selectOptions(props, customProps); },
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default InvoiceScheduler;