import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import NumbersIcon from '@mui/icons-material/Numbers';

import CustomActions from './Action';
import {
  ExtensionProperties,
  ExtensionPropertyList,
} from './ExtensionProperties';
import RouteType from './Field/RouteType';

const allRoutableFields = [
  'numberCountry',
  'numberValue',
  'ivr',
  'user',
  'huntGroup',
  'voicemail',
  'conferenceRoom',
  'friendValue',
  'queue',
  'conditionalRoute',
  'locution',
];

const properties: ExtensionProperties = {
  number: {
    label: _('Number'),
    helpText: _('Minimal length: 2'),
  },
  routeType: {
    label: _('Route type'),
    component: RouteType,
    enum: {
      user: _('User', { count: 1 }),
      ivr: _('IVR', { count: 1 }),
      huntGroup: _('Hunt Group', { count: 1 }),
      conferenceRoom: _('Conference room', { count: 1 }),
      number: _('Number'),
      friend: _('Friend', { count: 1 }),
      queue: _('Queue', { count: 1 }),
      conditional: _('Conditional Route', { count: 1 }),
      voicemail: _('Voicemail', { count: 1 }),
      locution: _('Voiceover and hang up'),
    },
    default: '__null__',
    null: _('Unassigned'),
    visualToggle: {
      __null__: {
        show: [],
        hide: allRoutableFields,
      },
      user: {
        show: ['user'],
        hide: allRoutableFields,
      },
      ivr: {
        show: ['ivr'],
        hide: allRoutableFields,
      },
      huntGroup: {
        show: ['huntGroup'],
        hide: allRoutableFields,
      },
      conferenceRoom: {
        show: ['conferenceRoom'],
        hide: allRoutableFields,
      },
      number: {
        show: ['numberCountry', 'numberValue'],
        hide: allRoutableFields,
      },
      friend: {
        show: ['friendValue'],
        hide: allRoutableFields,
      },
      queue: {
        show: ['queue'],
        hide: allRoutableFields,
      },
      conditional: {
        show: ['conditionalRoute'],
        hide: allRoutableFields,
      },
      voicemail: {
        show: ['voicemail'],
        hide: allRoutableFields,
      },
      locution: {
        show: ['locution'],
        hide: allRoutableFields,
      },
    },
  },
  numberCountry: {
    label: _('Country', { count: 1 }),
    required: true,
  },
  numberValue: {
    label: _('Number'),
    required: true,
  },
  ivr: {
    label: _('IVR', { count: 1 }),
    required: true,
  },
  huntGroup: {
    label: _('Hunt Group', { count: 1 }),
    required: true,
  },
  conferenceRoom: {
    label: _('Conference room', { count: 1 }),
    required: true,
  },
  user: {
    label: _('User', { count: 1 }),
    required: true,
  },
  friendValue: {
    label: _('Friend value'),
    required: true,
  },
  queue: {
    label: _('Queue', { count: 1 }),
    required: true,
  },
  conditionalRoute: {
    label: _('Conditional Route', { count: 1 }),
    required: true,
  },
  voicemail: {
    label: _('Voicemail', { count: 1 }),
    required: true,
  },
  locution: {
    label: _('Voiceover and hang up'),
    null: _('Direct hangup'),
  },
  target: {
    label: _('Target'),
    memoize: false,
  },
};

const columns = ['number', 'routeType', 'target'];

const extension: EntityInterface = {
  ...defaultEntityBehavior,
  icon: NumbersIcon,
  link: '/doc/${language}/administration_portal/client/vpbx/extensions.html',
  iden: 'Extension',
  title: _('Extension', { count: 2 }),
  path: '/extensions',
  toStr: (row: ExtensionPropertyList<string>) => `${row.number}`,
  defaultOrderBy: '',
  columns,
  properties,
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'Extensions',
  },
  customActions: CustomActions,
  selectOptions: async () => {
    const module = await import('./SelectOptions');

    return module.default;
  },
  foreignKeyResolver: async () => {
    const module = await import('./ForeignKeyResolver');

    return module.default;
  },
  Form: async () => {
    const module = await import('./Form');

    return module.default;
  },
};

export default extension;
