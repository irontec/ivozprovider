import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import FormatListNumberedIcon from '@mui/icons-material/FormatListNumbered';

import Target from './Field/Target';
import { IvrEntryProperties, IvrEntryPropertyList } from './IvrEntryProperties';

const toggleFlds = [
  'numberCountry',
  'numberValue',
  'extension',
  'voicemail',
  'conditionalRoute',
];

const properties: IvrEntryProperties = {
  ivr: {
    label: _('IVR', { count: 1 }),
  },
  entry: {
    label: _('Entry'),
    required: true,
    helpText: _(
      'You can use regular expressions to define values this entry will match.'
    ),
  },
  displayName: {
    label: _('Display name'),
    helpText: _('This value will be displayed in the called terminals'),
  },
  welcomeLocution: {
    label: _('Success locution'),
    null: _('Unassigned'),
    default: '__null__',
  },
  routeType: {
    label: _('Target type'),
    required: true,
    enum: {
      number: _('Number'),
      extension: _('Extension', { count: 1 }),
      voicemail: _('Voicemail', { count: 1 }),
      conditional: _('Conditional Route', { count: 1 }),
    },
    visualToggle: {
      __null__: {
        show: [],
        hide: toggleFlds,
      },
      number: {
        show: ['numberCountry', 'numberValue'],
        hide: toggleFlds,
      },
      extension: {
        show: ['extension'],
        hide: toggleFlds,
      },
      voicemail: {
        show: ['voicemail'],
        hide: toggleFlds,
      },
      conditional: {
        show: ['conditionalRoute'],
        hide: toggleFlds,
      },
    },
    null: _('Unassigned'),
    default: '__null__',
  },
  numberCountry: {
    label: _('Country', { count: 1 }),
    required: true,
  },
  numberValue: {
    label: _('Number'),
    required: true,
  },
  extension: {
    label: _('Extension', { count: 1 }),
    required: true,
    null: _('Unassigned'),
    default: '__null__',
  },
  voicemail: {
    label: _('Voicemail', { count: 1 }),
    required: true,
    null: _('Unassigned'),
    default: '__null__',
  },
  conditionalRoute: {
    label: _('Conditional Route', { count: 1 }),
    required: true,
    null: _('Unassigned'),
    default: '__null__',
  },
  target: {
    label: _('Target'),
    component: Target,
    memoize: false,
  },
};

const IvrEntry: EntityInterface = {
  ...defaultEntityBehavior,
  icon: FormatListNumberedIcon,
  iden: 'IvrEntry',
  title: _('IVR entry', { count: 2 }),
  path: '/ivr_entries',
  toStr: (row: IvrEntryPropertyList<string>) => `${row.id}`,
  properties,
  columns: ['entry', 'displayName', 'welcomeLocution', 'routeType', 'target'],
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'IVREntries',
  },
  defaultOrderBy: '',
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

export default IvrEntry;
