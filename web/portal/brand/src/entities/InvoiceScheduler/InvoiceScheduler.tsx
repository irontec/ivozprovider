import { EntityValues } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import ManageHistoryIcon from '@mui/icons-material/ManageHistory';

import LastExecution from './Field/LastExecution';
import {
  InvoiceSchedulerProperties,
  InvoiceSchedulerPropertyList,
} from './InvoiceSchedulerProperties';

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
    required: false,
  },
  lastExecution: {
    label: _('Last execution'),
    readOnly: true,
    component: LastExecution,
  },
  lastExecutionError: {
    label: _('Last execution error'),
  },
  nextExecution: {
    label: _('Next execution'),
  },
  taxRate: {
    label: _('Tax rate'),
    suffix: '%',
  },
  id: {
    label: _('Id'),
  },
  invoiceTemplate: {
    label: _('Template'),
  },
  company: {
    label: _('Client'),
  },
  numberSequence: {
    label: _('Invoice number sequence', { count: 1 }),
    required: true,
    //@TODO visualToggle
  },
};

const InvoiceScheduler: EntityInterface = {
  ...defaultEntityBehavior,
  icon: ManageHistoryIcon,
  link: '/doc/en/administration_portal/brand/invoicing/invoice_schedulers.html',
  iden: 'InvoiceScheduler',
  title: _('Invoice Scheduler', { count: 2 }),
  path: '/invoice_schedulers',
  toStr: (row: InvoiceSchedulerPropertyList<EntityValues>) => `${row.name}`,
  properties,
  columns: [
    'name',
    'company',
    'frequency',
    'unit',
    'lastExecution',
    'nextExecution',
  ],
  defaultOrderBy: '',
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'InvoiceSchedulers',
  },
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
};

export default InvoiceScheduler;
