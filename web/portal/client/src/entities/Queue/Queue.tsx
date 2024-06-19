import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import HourglassTopIcon from '@mui/icons-material/HourglassTop';

import Strategy from './Field/Strategy';
import { QueueProperties, QueuePropertyList } from './QueueProperties';

const timeoutFields = [
  'timeoutNumberCountry',
  'timeoutNumberValue',
  'timeoutExtension',
  'timeoutVoicemail',
];

const fullFields = [
  'fullNumberCountry',
  'fullNumberValue',
  'fullExtension',
  'fullVoicemail',
];

const properties: QueueProperties = {
  name: {
    label: _('Name'),
    required: true,
    helpText: _("Allowed characters: a-z, A-Z, 0-9, underscore and '-'"),
  },
  displayName: {
    label: _('Display name'),
    helpText: _('This value will be displayed in the called terminals'),
  },
  maxWaitTime: {
    label: _('Max wait time'),
    helpText: _(
      'If no queue member answers before time this seconds, the timeout queue logic will be activated. Leave empty to disable.'
    ),
  },
  timeoutLocution: {
    label: _('Locution', { count: 1 }),
    null: _('Unassigned'),
  },
  timeoutTargetType: {
    label: _('Timeout route'),
    enum: {
      number: _('Number'),
      extension: _('Extension', { count: 1 }),
      voicemail: _('Voicemail', { count: 1 }),
    },
    null: _('Unassigned'),
    default: '__null__',
    visualToggle: {
      __null__: {
        show: [],
        hide: timeoutFields,
      },
      number: {
        show: ['timeoutNumberCountry', 'timeoutNumberValue'],
        hide: timeoutFields,
      },
      extension: {
        show: ['timeoutExtension'],
        hide: timeoutFields,
      },
      voicemail: {
        show: ['timeoutVoicemail'],
        hide: timeoutFields,
      },
    },
  },
  timeoutNumberCountry: {
    label: _('Country', { count: 1 }),
    required: true,
  },
  timeoutNumberValue: {
    label: _('Number'),
    required: true,
  },
  timeoutExtension: {
    label: _('Extension', { count: 1 }),
    required: true,
  },
  timeoutVoicemail: {
    label: _('Voicemail', { count: 1 }),
    required: true,
  },
  maxlen: {
    label: _('Max queue length'),
    helpText: _(
      'Max number of unattended calls that this queue can have. When this value has been reached, full queue logic will be activated on new calls. Leave empty to disable.'
    ),
  },
  fullLocution: {
    label: _('Full queue Locution'),
    null: _('Unassigned'),
  },
  fullTargetType: {
    label: _('Full queue route'),
    enum: {
      number: _('Number'),
      extension: _('Extension', { count: 1 }),
      voicemail: _('Voicemail', { count: 1 }),
    },
    null: _('Unassigned'),
    default: '__null__',
    visualToggle: {
      __null__: {
        show: [],
        hide: fullFields,
      },
      number: {
        show: ['fullNumberCountry', 'fullNumberValue'],
        hide: fullFields,
      },
      extension: {
        show: ['fullExtension'],
        hide: fullFields,
      },
      voicemail: {
        show: ['fullVoicemail'],
        hide: fullFields,
      },
    },
  },
  fullNumberCountry: {
    label: _('Country', { count: 1 }),
    required: true,
  },
  fullNumberValue: {
    label: _('Number'),
    required: true,
  },
  fullExtension: {
    label: _('Extension', { count: 1 }),
    required: true,
  },
  fullVoicemail: {
    label: _('Voicemail', { count: 1 }),
    required: true,
  },
  periodicAnnounceLocution: {
    label: _('Periodic Annouce Locution'),
    null: _('Unassigned'),
    default: '__null__',
    helpText: _('Locution periodically played to calls that are queued'),
  },
  periodicAnnounceFrequency: {
    label: _('Periodic Announce Frequency'),
  },
  announcePosition: {
    label: _('Announce Queue position'),
    default: 'no',
    helpText: _(
      'Announce queue position to waiting users when they enter the queue and after defined frequency'
    ),
    enum: {
      yes: _('Yes'),
      no: _('No'),
    },
    visualToggle: {
      yes: {
        show: ['announceFrequency'],
        hide: [],
      },
      no: {
        show: [],
        hide: ['announceFrequency'],
      },
    },
  },
  announceFrequency: {
    label: _('Announce Queue position frequency'),
  },
  memberCallRest: {
    label: _('Member rest seconds'),
    default: 0,
    helpText: _(
      "Time in seconds that member won't be disturbed after attending a queue call"
    ),
  },
  memberCallTimeout: {
    label: _('Member call seconds'),
    default: 5,
    helpText: _('Time in seconds queue calls will ring members'),
  },
  strategy: {
    label: _('Strategy'),
    component: Strategy,
    enum: {
      ringall: _('Ring all'),
      leastrecent: _('Least recent'),
      fewestcalls: _('Fewest calls'),
      random: _('Random'),
      rrmemory: _('Round Robin memory'),
      linear: _('Linear'),
    },
    default: 'rrmemory',
    helpText: _('Determines the order current priority members will be called'),
  },
  weight: {
    label: _('Weight'),
    default: 5,
  },
  preventMissedCalls: {
    label: _('Prevent missed calls'),
    enum: {
      '0': _('No'),
      '1': _('Yes'),
    },
    default: '1',
    helpText: _(
      "When 'Yes', calls will never generate a missed call. When 'No', missed calls will be prevented only for RingAll queues if someone answers."
    ),
  },
};

const columns = [
  'name',
  'strategy',
  'weight',
  'memberCallTimeout',
  'memberCallRest',
  'maxWaitTime',
  'maxlen',
];

const queue: EntityInterface = {
  ...defaultEntityBehavior,
  icon: HourglassTopIcon,
  link: '/doc/en/administration_portal/client/vpbx/routing_endpoints/queues.html',
  iden: 'Queue',
  title: _('Queue', { count: 2 }),
  path: '/queues',
  toStr: (row: QueuePropertyList<string>) => `${row.name}`,
  properties,
  columns,
  defaultOrderBy: '',
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'Queues',
  },
  selectOptions: async () => {
    const module = await import('./SelectOptions');

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

export default queue;
