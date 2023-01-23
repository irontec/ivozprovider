import DialpadIcon from '@mui/icons-material/Dialpad';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import Form from './Form';
import { foreignKeyGetter } from './ForeignKeyGetter';
import { DdiProperties } from './DdiProperties';
import foreignKeyResolver from './ForeignKeyResolver';
import selectOptions from './SelectOptions';
import RouteType from './Field/RouteType';

const allRoutableFields = [
  'ivr',
  'huntGroup',
  'user',
  'fax',
  'conferenceRoom',
  'friendValue',
  'queue',
  'residentialDevice',
  'conditionalRoute',
  'retailAccount',
];

const properties: DdiProperties = {
  ddi: {
    label: _('DDI', { count: 1 }),
  },
  description: {
    label: _('Description'),
  },
  externalCallFilter: {
    label: _('External call filter'),
  },
  routeType: {
    label: _('Route type'),
    component: RouteType,
    enum: {
      user: _('User', { count: 1 }),
      ivr: _('IVR'),
      huntGroup: _('Hunt Group'),
      fax: _('Fax', { count: 1 }),
      conferenceRoom: _('Conference room'),
      friend: _('Friend', { count: 1 }),
      queue: _('Queue'),
      residential: _('Residential Device', { count: 1 }),
      conditional: _('Conditional Route'),
      retail: _('Retail Account', { count: 1 }),
    },
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
      fax: {
        show: ['fax'],
        hide: allRoutableFields,
      },
      conferenceRoom: {
        show: ['conferenceRoom'],
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
      residential: {
        show: ['residentialDevice', 'recordCalls'],
        hide: allRoutableFields,
      },
      conditional: {
        show: ['conditionalRoute'],
        hide: allRoutableFields,
      },
      retail: {
        show: ['retailAccount'],
        hide: allRoutableFields,
      },
    },
  },
  recordCalls: {
    label: _('Record call'),
    helpText: _(
      'Local legislation may enforce to announce the call recording to both parties, act responsibly'
    ),
    enum: {
      none: _('None'),
      all: _('All'),
      inbound: _('Inbound'),
      outbound: _('Outbound'),
    },
    default: 'none',
  },
  displayName: {
    label: _('Display name'),
    helpText: _('This value will be displayed in the called terminals'),
  },
  user: {
    label: _('User', { count: 1 }),
  },
  ivr: {
    label: _('IVR'),
  },
  huntGroup: {
    label: _('Hunt Group'),
  },
  fax: {
    label: _('Fax', { count: 1 }),
  },
  conferenceRoom: {
    label: _('Conference room'),
  },
  residentialDevice: {
    label: _('Residential Device', { count: 1 }),
  },
  friendValue: {
    label: _('Friend value'),
  },
  country: {
    label: _('Country', { count: 1 }),
  },
  language: {
    label: _('Language', { count: 1 }),
    null: _("Client's default"),
  },
  queue: {
    label: _('Queue'),
  },
  conditionalRoute: {
    label: _('Conditional Route'),
  },
  retailAccount: {
    label: _('Retail Account', { count: 1 }),
  },
  target: {
    label: _('Target'),
    memoize: false,
  },
  ddiProvider: {
    label: _('DDI Provider', { count: 1 }),
    null: _('Unassigned'),
  },
  company: {
    label: _('Client'),
  },
};

const ddi: EntityInterface = {
  ...defaultEntityBehavior,
  icon: DialpadIcon,
  iden: 'Ddi',
  title: _('DDI', { count: 2 }),
  path: '/ddis',
  toStr: (row: any) => row.ddie164,
  properties,
  columns: ['country', 'ddi', 'company', 'ddiProvider', 'description'],
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'DDIs',
  },
  Form,
  foreignKeyGetter,
  foreignKeyResolver,
  selectOptions,
};

export default ddi;
