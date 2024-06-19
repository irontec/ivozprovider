import defaultEntityBehavior, {
  MarshallerValues,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import { PartialPropertyList } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import SettingsApplications from '@mui/icons-material/SettingsApplications';

import { CallCsvSchedulerProperties } from './CallCsvSchedulerProperties';
import LastExecution from './Field/LastExecution';

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
    required: false,
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
    label: _('DDI', { count: 1 }),
    null: _('All'),
    default: '__null__',
  },
  endpointType: {
    label: _('Endpoint type'),
    enum: {
      user: _('User', { count: 1 }),
      fax: _('Fax', { count: 1 }),
      friend: _('Friend', { count: 1 }),
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
    label: _('User', { count: 1 }),
    required: true,
  },
  retailAccount: {
    label: _('Retail Account', { count: 1 }),
    required: true,
  },
  residentialDevice: {
    label: _('Residential Device', { count: 1 }),
    required: true,
  },
  fax: {
    label: _('Fax', { count: 1 }),
    required: true,
  },
  friend: {
    label: _('Friend', { count: 1 }),
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
  link: '/doc/en/administration_portal/client/vpbx/calls/call_csv_schedulers.html',
  iden: 'CallCsvScheduler',
  title: _('Call CSV scheduler', { count: 2 }),
  path: '/call_csv_schedulers',
  properties,
  columns,
  defaultOrderBy: '',
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'CallCsvSchedulers',
  },
  Form: async () => {
    const module = await import('./Form');

    return module.default;
  },
  marshaller,
  unmarshaller,
};

export default CallCsvScheduler;
