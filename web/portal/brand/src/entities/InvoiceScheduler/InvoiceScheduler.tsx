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
  name: {
    label: _('Name'),
    maxLength: 40,
  },
  unit: {
    label: _('Unit'),
    default: 'month',
    enum: {
      week: _('Week'),
      month: _('Month'),
      year: _('Year'),
    },
  },
  frequency: {
    label: _('Frequency'),
    default: 1,
    minimum: 1,
  },
  email: {
    label: _('Email'),
    maxLength: 140,
  },
  lastExecution: {
    label: _('Last execution'),
    //@TODO IvozProvider_Klear_Ghost_SchedulerSuccess::getInvoiceSchedulerLastExecutionReport
  },
  lastExecutionError: {
    label: _('Last ExecutionError'),
  },
  nextExecution: {
    label: _('Next execution'),
  },
  taxRate: {
    label: _('Tax rate'),
    //@TODO sufix: "%"
  },
  id: {
    label: _('Id'),
  },
  invoiceTemplate: {
    label: _('Template'),
  },
  brand: {
    label: _('Brand'),
  },
  company: {
    label: _('Client'),
  },
  numberSequence: {
    label: _('Invoice number sequence'),
    //@TODO visualToggle
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
  selectOptions,
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default InvoiceScheduler;
