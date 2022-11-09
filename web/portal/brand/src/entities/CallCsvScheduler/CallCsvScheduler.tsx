import CalendarMonthIcon from '@mui/icons-material/CalendarMonth';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';
import Form from './Form';
import { foreignKeyGetter } from './ForeignKeyGetter';
import { CallCsvSchedulerProperties } from './CallCsvSchedulerProperties';
import foreignKeyResolver from './ForeignKeyResolver';
import LastExecution from './Field/LastExecution';

const properties: CallCsvSchedulerProperties = {
  //@TODO visualToggles
  name: {
    label: _('Name'),
    maxLength: 40,
  },
  unit: {
    label: _('Unit'),
    enum: {
      day: _('Day'),
      week: _('Week'),
      month: _('Month'),
    },
  },
  frequency: {
    label: _('Frequency'),
    default: 1,
  },
  callDirection: {
    label: _('Direction'),
    default: '__null__',
    enum: {
      __null__: _('Both'),
      inbound: _('Inbound'),
      outbound: _('Outbound'),
    },
    visualToggle: {
      __null__: {
        show: [],
        hide: ['carrier', 'ddiProvider'],
      },
      inbound: {
        show: ['ddiProvider'],
        hide: ['carrier'],
      },
      outbound: {
        show: ['carrier'],
        hide: ['ddiProvider'],
      },
    },
  },
  email: {
    label: _('Email'),
    maxLength: 140,
    helpText: _('Leave empty if no mail is needed (just generate CSV).'),
  },
  lastExecution: {
    label: _('Last Execution'),
    component: LastExecution,
  },
  lastExecutionError: {
    label: _('Last ExecutionError'),
  },
  nextExecution: {
    label: _('Next execution'),
    format: 'date-time',
  },
  company: {
    label: _('Client'),
  },
  //@TODO companyType
  callCsvNotificationTemplate: {
    label: _('Notification template'),
    null: _('Use generic template'),
  },
  ddi: {
    label: _('DDI'),
    null: _('All'),
  },
  carrier: {
    label: _('Carrier'),
    null: _('All'),
  },
  retailAccount: {
    label: _('Retail Account'),
    null: _('All'),
  },
  residentialDevice: {
    label: _('Residential Device'),
    null: _('All'),
  },
  user: {
    label: _('User'),
    null: _('All'),
  },
  fax: {
    label: _('Fax'),
    null: _('All'),
  },
  friend: {
    label: _('Friend'),
    null: _('All'),
  },
  ddiProvider: {
    label: _('Ddi Provider'),
    null: _('All'),
  },
};

const CallCsvScheduler: EntityInterface = {
  ...defaultEntityBehavior,
  icon: CalendarMonthIcon,
  iden: 'CallCsvScheduler',
  title: _('Call CSV scheduler', { count: 2 }),
  path: '/call_csv_schedulers',
  toStr: (row: any) => row.name,
  properties,
  columns: [
    'name',
    'company',
    'callDirection',
    'email',
    'frequency',
    'unit',
    'lastExecution',
    'nextExecution',
  ],
  selectOptions,
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default CallCsvScheduler;
