import defaultEntityBehavior from '@irontec-voip/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec-voip/ivoz-ui/entities/EntityInterface';
import _ from '@irontec-voip/ivoz-ui/services/translations/translate';
import SwitchCameraIcon from '@mui/icons-material/SwitchCamera';

import {
  ConditionalRouteProperties,
  ConditionalRoutePropertyList,
} from './ConditionalRouteProperties';
import RouteType from './Field/RouteType';

const routableFields = [
  'numberCountry',
  'numbervalue',
  'ivr',
  'user',
  'huntGroup',
  'voicemail',
  'friendvalue',
  'queue',
  'conferenceRoom',
  'extension',
];

const properties: ConditionalRouteProperties = {
  name: {
    label: _('Name'),
  },
  locution: {
    label: _('Locution', { count: 1 }),
    null: _('Unassigned'),
    default: '__null__',
  },
  routetype: {
    label: _('Route type'),
    component: RouteType,
    enum: {
      user: _('User', { count: 1 }),
      ivr: _('IVR', { count: 1 }),
      huntGroup: _('Hunt Group', { count: 1 }),
      voicemail: _('Voicemail', { count: 1 }),
      number: _('Number'),
      friend: _('Friend', { count: 1 }),
      queue: _('Queue', { count: 1 }),
      conferenceRoom: _('Conference room', { count: 1 }),
      extension: _('Extension', { count: 1 }),
    },
    null: _('Unassigned'),
    default: '__null__',
    visualToggle: {
      __null__: {
        show: [],
        hide: routableFields,
      },
      user: {
        show: ['user'],
        hide: routableFields,
      },
      ivr: {
        show: ['ivr'],
        hide: routableFields,
      },
      huntGroup: {
        show: ['huntGroup'],
        hide: routableFields,
      },
      voicemail: {
        show: ['voicemail'],
        hide: routableFields,
      },
      number: {
        show: ['numberCountry', 'numbervalue'],
        hide: routableFields,
      },
      friend: {
        show: ['friendvalue'],
        hide: routableFields,
      },
      queue: {
        show: ['queue'],
        hide: routableFields,
      },
      conferenceRoom: {
        show: ['conferenceRoom'],
        hide: routableFields,
      },
      extension: {
        show: ['extension'],
        hide: routableFields,
      },
    },
  },
  ivr: {
    label: _('IVR', { count: 1 }),
    required: true,
  },
  huntGroup: {
    label: _('Hunt Group', { count: 1 }),
    required: true,
  },
  voicemail: {
    label: _('Voicemail', { count: 1 }),
    required: true,
  },
  user: {
    label: _('User', { count: 1 }),
    required: true,
  },
  numberCountry: {
    label: _('Country', { count: 1 }),
    required: true,
  },
  numbervalue: {
    label: _('Number'),
    required: true,
  },
  friendvalue: {
    label: _('Friend value'),
    required: true,
  },
  queue: {
    label: _('Queue', { count: 1 }),
    required: true,
  },
  conferenceRoom: {
    label: _('Conference room', { count: 1 }),
    required: true,
  },
  extension: {
    label: _('Extension', { count: 1 }),
    required: true,
  },
  target: {
    label: _('Target'),
    memoize: false,
  },
};

const columns = ['name', 'locution', 'routetype', 'target'];

const ConditionalRoute: EntityInterface = {
  ...defaultEntityBehavior,
  icon: SwitchCameraIcon,
  link: '/doc/en/administration_portal/client/vpbx/routing_endpoints/conditional_routes.html',
  iden: 'ConditionalRoute',
  title: _('Conditional Route', { count: 2 }),
  path: '/conditional_routes',
  toStr: (row: ConditionalRoutePropertyList<string>) => `${row.name}`,
  properties,
  columns,
  defaultOrderBy: '',
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'ConditionalRoutes',
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

export default ConditionalRoute;
