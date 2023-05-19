import { EntityValues } from '@irontec/ivoz-ui';
import defaultEntityBehavior, {
  marshaller as defaultMarshaller,
  unmarshaller as defaultUnmarshaller,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import CalendarMonthIcon from '@mui/icons-material/CalendarMonth';

import {
  CallCsvSchedulerProperties,
  CallCsvSchedulerPropertyList,
} from './CallCsvSchedulerProperties';

const properties: CallCsvSchedulerProperties = {
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
    required: false,
    default: '',
    helpText: _('Leave empty if no mail is needed (just generate CSV).'),
  },
  lastExecution: {
    label: _('Last execution'),
  },
  lastExecutionError: {
    label: _('Last execution error'),
  },
  nextExecution: {
    label: _('Next execution'),
    format: 'date-time',
  },
  companyType: {
    label: _('Client Type'),
    type: 'string',
    required: false,
    null: _('All'),
    default: '__null__',
    enum: {
      vpbx: _('vPBX'),
      retail: _('Retail'),
      residential: _('Residential', { count: 1 }),
      wholesale: _('Wholesale', { count: 1 }),
    },
    visualToggle: {
      __null__: {
        show: ['callCsvNotificationTemplate'],
        hide: [
          'wholesale',
          'retail',
          'residential',
          'vpbx',
          'residentialDevice',
          'retailAccount',
          'ddi',
          'user',
          'fax',
          'friend',
          'endpointType',
          'residentialEndpointType',
        ],
      },
      vpbx: {
        show: ['vpbx'],
        hide: [
          'retail',
          'residential',
          'wholesale',
          'residentialDevice',
          'retailAccount',
          'callCsvNotificationTemplate',
          'residentialEndpointType',
        ],
      },
      retail: {
        show: ['retail'],
        hide: [
          'wholesale',
          'vpbx',
          'residential',
          'residentialDevice',
          'callCsvNotificationTemplate',
          'user',
          'fax',
          'friend',
          'endpointType',
          'residentialEndpointType',
          'retailAccount',
        ],
      },
      residential: {
        show: ['residential'],
        hide: [
          'wholesale',
          'vpbx',
          'retail',
          'retailAccount',
          'callCsvNotificationTemplate',
          'user',
          'fax',
          'friend',
          'endpointType',
          'residentialEndpointType',
          'residentialDevice',
        ],
      },
      wholesale: {
        show: ['wholesale'],
        hide: [
          'vpbx',
          'retail',
          'residential',
          'retailAccount',
          'residentialDevice',
          'callCsvNotificationTemplate',
          'user',
          'fax',
          'friend',
          'endpointType',
          'residentialEndpointType',
          'ddi',
        ],
      },
    },
  },
  company: {
    label: _('Client'),
  },
  wholesale: {
    label: _('Client wholesale'),
    $ref: '#/definitions/Company',
    type: 'integer',
    null: ' ',
    default: '__null__',
  },
  vpbx: {
    label: _('Client vpbx'),
    $ref: '#/definitions/Company',
    type: 'integer',
    null: ' ',
    default: '__null__',
    visualToggle: {
      __default__: {
        show: ['ddi', 'endpointType'],
        hide: [],
      },
      __null__: {
        show: [],
        hide: ['ddi', 'endpointType', 'user', 'friend', 'fax'],
      },
    },
  },
  retail: {
    label: _('Client retail'),
    $ref: '#/definitions/Company',
    type: 'integer',
    null: ' ',
    default: '__null__',
    visualToggle: {
      __default__: {
        show: ['ddi', 'retailAccount'],
        hide: [],
      },
      __null__: {
        show: [],
        hide: ['ddi', 'retailAccount'],
      },
    },
  },
  residential: {
    label: _('Client residential'),
    $ref: '#/definitions/Company',
    type: 'integer',
    null: ' ',
    default: '__null__',
    visualToggle: {
      __default__: {
        show: ['ddi', 'residentialEndpointType'],
        hide: [],
      },
      __null__: {
        show: [],
        hide: ['ddi', 'residentialEndpointType'],
      },
    },
  },
  callCsvNotificationTemplate: {
    label: _('Notification template', { count: 1 }),
    null: _('Use generic template'),
    default: '__null__',
  },
  ddi: {
    label: _('DDI', { count: 1 }),
    null: _('All'),
    default: '__null__',
  },
  carrier: {
    label: _('Carrier', { count: 1 }),
    null: _('All'),
    default: '__null__',
  },
  retailAccount: {
    label: _('Retail Account', { count: 1 }),
    $ref: '#/definitions/RetailAccount',
    null: _('All'),
    default: '__null__',
  },
  residentialDevice: {
    label: _('Residential Device', { count: 1 }),
    $ref: '#/definitions/ResidentialDevice',
    null: _('All'),
    default: '__null__',
  },
  user: {
    label: _('User', { count: 1 }),
    $ref: '#/definitions/User',
    null: _('All'),
    default: '__null__',
  },
  fax: {
    label: _('Fax', { count: 1 }),
    $ref: '#/definitions/Fax',
    null: _('All'),
    default: '__null__',
  },
  friend: {
    label: _('Friend', { count: 1 }),
    $ref: '#/definitions/Friend',
    null: _('All'),
    default: '__null__',
  },
  ddiProvider: {
    label: _('DDI Provider', { count: 1 }),
    $ref: '#/definitions/DdiProvider',
    null: _('All'),
    default: '__null__',
  },
  endpointType: {
    label: _('Endpoint Type'),
    type: 'string',
    null: _('All'),
    default: '__null__',
    enum: {
      user: _('User', { count: 1 }),
      fax: _('Fax', { count: 1 }),
      friend: _('Friend', { count: 1 }),
    },
    visualToggle: {
      __null__: {
        show: [],
        hide: ['user', 'fax', 'friend'],
      },
      user: {
        show: ['user'],
        hide: ['fax', 'friend'],
      },
      fax: {
        show: ['fax'],
        hide: ['user', 'friend'],
      },
      friend: {
        show: ['friend'],
        hide: ['user', 'fax'],
      },
    },
  },
  residentialEndpointType: {
    label: _('Endpoint Type'),
    type: 'string',
    null: _('All'),
    default: '__null__',
    enum: {
      residentialDevice: _('Residential Device', { count: 1 }),
      fax: _('Fax', { count: 1 }),
    },
    visualToggle: {
      __null__: {
        show: [],
        hide: ['residentialDevice', 'fax'],
      },
      residentialDevice: {
        show: ['residentialDevice'],
        hide: ['fax'],
      },
      fax: {
        show: ['fax'],
        hide: ['residentialDevice'],
      },
    },
  },
};

type MarshallerType = typeof defaultMarshaller;
const marshaller: MarshallerType = (values, properties) => {
  values.company = values[values.companyType];

  return defaultMarshaller(values, properties);
};

type UnmarshallerType = typeof defaultUnmarshaller;
const unmarshaller: UnmarshallerType = (row, properties) => {
  row.companyType = row.company?.type;
  row[row.companyType] = row.company?.id;
  if (row.user) {
    row.endpointType = 'user';
  }
  if (row.fax) {
    row.endpointType = 'fax';
    row.residentialEndpointType = 'fax';
  }
  if (row.friend) {
    row.endpointType = 'friend';
  }
  if (row.residentialDevice) {
    row.residentialEndpointType = 'residentialDevice';
  }

  return defaultUnmarshaller(row, properties);
};

const CallCsvScheduler: EntityInterface = {
  ...defaultEntityBehavior,
  icon: CalendarMonthIcon,
  iden: 'CallCsvScheduler',
  title: _('Call CSV Scheduler', { count: 2 }),
  path: '/call_csv_schedulers',
  toStr: (row: CallCsvSchedulerPropertyList<EntityValues>) => `${row.id}`,
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

export default CallCsvScheduler;
