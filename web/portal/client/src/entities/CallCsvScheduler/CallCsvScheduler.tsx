import SettingsApplications from '@mui/icons-material/SettingsApplications';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior, {
  MarshallerValues,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import Form from './Form';
import LastExecution from './Field/LastExecution';
import { CallCsvSchedulerProperties } from './CallCsvSchedulerProperties';
import { PartialPropertyList } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';

const properties: CallCsvSchedulerProperties = {
  name: {
    label: _('Name'),
  },
  callDirection: {
    label: _('Direction'),
    enum: {
      outbound: _('Outbound'),
      inbound: _('Inbound'),
    },
    null: _('Both'),
    default: '__null__',
  },
  frequency: {
    label: _('Frequency'),
    default: 1,
  },
  unit: {
    label: _('Unit'),
    enum: {
      day: _('Day'),
      week: _('Week'),
      month: _('Month'),
    },
    default: 'month',
  },
  email: {
    label: _('Email'),
    helpText: _('Leave empty if no mail is needed (just generate CSV).'),
    default: '',
  },
  lastExecution: {
    label: _('Last execution'),
    component: LastExecution,
  },
  nextExecution: {
    label: _('Next execution'),
  },
  callCsvNotificationTemplate: {
    label: _('Notification template'),
  },
  ddi: {
    label: _('DDI'),
    null: _('All'),
    default: '__null__',
  },
  endpointType: {
    label: _('Endpoint type'),
    enum: {
      user: _('User'),
      fax: _('Fax'),
      friend: _('Friend'),
    },
    null: _('All'),
    visualToggle: {
      __null__: {
        show: [],
        hide: ['user', 'retailAccount', 'residentialDevice', 'fax', 'friend'],
      },
      user: {
        show: ['user', 'retailAccount', 'residentialDevice'],
        hide: ['fax', 'friend'],
      },
      fax: {
        show: ['fax'],
        hide: ['user', 'retailAccount', 'residentialDevice', 'friend'],
      },
      friend: {
        show: ['friend'],
        hide: ['user', 'retailAccount', 'residentialDevice', 'fax', 'friend'],
      },
    },
  },
  user: {
    label: _('User'),
    required: true,
  },
  retailAccount: {
    label: _('Retail Account'),
    required: true,
  },
  residentialDevice: {
    label: _('Residential Device'),
    required: true,
  },
  fax: {
    label: _('Fax'),
    required: true,
  },
  friend: {
    label: _('Friend'),
    required: true,
  },
};

const columns = [
  'name',
  'callDirection',
  'email',
  'frequency',
  'unit',
  'lastExecution',
  'nextExecution',
];

export const marshaller = (
  values: CallCsvSchedulerProperties,
  properties: PartialPropertyList
): MarshallerValues => {
  if (values.endpointType) {
    delete values.endpointType;
  }

  const response = defaultEntityBehavior.marshaller(values, properties);

  return response;
};

export const unmarshaller = (
  row: CallCsvSchedulerProperties,
  properties: PartialPropertyList
): MarshallerValues => {
  const response = defaultEntityBehavior.unmarshaller(row, properties);

  if (response.user) {
    response.endpointType = 'user';
  } else if (response.fax) {
    response.endpointType = 'fax';
  } else if (response.friend) {
    response.endpointType = 'friend';
  } else {
    response.endpointType = '__null__';
  }

  return response;
};

const CallCsvScheduler: EntityInterface = {
  ...defaultEntityBehavior,
  icon: SettingsApplications,
  iden: 'CallCsvScheduler',
  title: _('Call csv scheduler', { count: 2 }),
  path: '/call_csv_schedulers',
  properties,
  columns,
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'CallCsvSchedulers',
  },
  Form,
  marshaller,
  unmarshaller,
};

export default CallCsvScheduler;
