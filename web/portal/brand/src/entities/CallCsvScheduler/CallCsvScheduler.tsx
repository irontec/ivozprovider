import AccountTreeIcon from '@mui/icons-material/AccountTree';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';
import Form from './Form';
import { foreignKeyGetter } from './ForeignKeyGetter';
import { CallCsvSchedulerProperties } from './CallCsvSchedulerProperties';
import foreignKeyResolver from './ForeignKeyResolver';

const properties: CallCsvSchedulerProperties = {
  'name': {
    label: _('Name'),
  },
  'unit': {
    label: _('Unit'),
    enum: {
      'day' : _('Day'),
      'week' : _('Week'),
      'month' : _('Month'),
    },
  },
  'frequency': {
    label: _('Frequency'),
  },
  'callDirection': {
    label: _('Call Direction'),
    enum: {
      'inbound' : _('Inbound'),
      'outbound' : _('Outbound'),
    },
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
  'id': {
    label: _('Id'),
  },
  'company': {
    label: _('Company'),
  },
  'callCsvNotificationTemplate': {
    label: _('Call CsvNotificationTemplate'),
  },
  'ddi': {
    label: _('Ddi'),
  },
  'carrier': {
    label: _('Carrier'),
  },
  'retailAccount': {
    label: _('Retail Account'),
  },
  'residentialDevice': {
    label: _('Residential Device'),
  },
  'user': {
    label: _('User'),
  },
  'fax': {
    label: _('Fax'),
  },
  'friend': {
    label: _('Friend'),
  },
  'ddiProvider': {
    label: _('Ddi Provider'),
  },
};

const CallCsvScheduler: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AccountTreeIcon,
  iden: 'CallCsvScheduler',
  title: _('CallCsvScheduler', { count: 2 }),
  path: '/CallCsvSchedulers',
  toStr: (row: any) => row.id,
  properties,
  selectOptions: (props, customProps) => { return selectOptions(props, customProps); },
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default CallCsvScheduler;