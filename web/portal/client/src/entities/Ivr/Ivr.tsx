import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import AccountTreeIcon from '@mui/icons-material/AccountTree';

import { IvrProperties, IvrPropertyList } from './IvrProperties';

const noInputFields = [
  'noInputNumberCountry',
  'noInputNumberValue',
  'noInputExtension',
  'noInputVoicemail',
];

const errorFields = [
  'errorNumberCountry',
  'errorNumberValue',
  'errorExtension',
  'errorVoicemail',
];

const properties: IvrProperties = {
  name: {
    label: _('Name'),
    required: true,
  },
  welcomeLocution: {
    label: _('Welcome locution'),
    null: _('Unassigned'),
  },
  noInputLocution: {
    label: _('No input locution'),
    null: _('Unassigned'),
  },
  errorLocution: {
    label: _('Locution', { count: 1 }),
    null: _('Unassigned'),
  },
  successLocution: {
    label: _('Success locution'),
    null: _('Unassigned'),
  },
  timeout: {
    label: _('Timeout'),
    default: 6,
    helpText: _(
      'Time in seconds the IVR will wait after playing the welcome locution or dialing a digit'
    ),
    required: true,
  },
  maxDigits: {
    label: _('Max digits'),
    default: 0,
    helpText: _(
      'Max number of digits the caller can enter. Set to 0 to disable.'
    ),
    required: true,
  },
  allowExtensions: {
    label: _('Allow dialing extensions'),
    enum: {
      '0': _('No'),
      '1': _('Yes'),
    },
    default: 0,
    visualToggle: {
      '0': {
        show: [],
        hide: ['excludedExtensionIds'],
      },
      '1': {
        show: ['excludedExtensionIds'],
        hide: [],
      },
    },
  },
  excludedExtensionIds: {
    label: _('Excluded Extensions'),
  },
  noInputRouteType: {
    label: _('No input target type'),
    default: '__null__',
    null: _('Unassigned'),
    enum: {
      number: _('Number'),
      extension: _('Extension', { count: 1 }),
      voicemail: _('Voicemail', { count: 1 }),
    },
    visualToggle: {
      __null__: {
        show: [],
        hide: noInputFields,
      },
      number: {
        show: ['noInputNumberValue', 'noInputNumberCountry'],
        hide: noInputFields,
      },
      extension: {
        show: ['noInputExtension'],
        hide: noInputFields,
      },
      voicemail: {
        show: ['noInputVoicemail'],
        hide: noInputFields,
      },
    },
  },
  noInputNumberCountry: {
    label: _('Country', { count: 1 }),
    required: true,
  },
  noInputNumberValue: {
    label: _('Number'),
    required: true,
  },
  noInputExtension: {
    label: _('Extension', { count: 1 }),
    required: true,
  },
  noInputVoicemail: {
    label: _('Voicemail', { count: 1 }),
    required: true,
  },
  errorRouteType: {
    label: _('Error target type'),
    default: '__null__',
    null: _('Unassigned'),
    enum: {
      number: _('Number'),
      extension: _('Extension', { count: 1 }),
      voicemail: _('Voicemail', { count: 1 }),
    },
    visualToggle: {
      __null__: {
        show: [],
        hide: errorFields,
      },
      number: {
        show: ['errorNumberValue', 'errorNumberCountry'],
        hide: errorFields,
      },
      extension: {
        show: ['errorExtension'],
        hide: errorFields,
      },
      voicemail: {
        show: ['errorVoicemail'],
        hide: errorFields,
      },
    },
  },
  errorNumberCountry: {
    label: _('Country', { count: 1 }),
    required: true,
  },
  errorNumberValue: {
    label: _('Number'),
    required: true,
  },
  errorExtension: {
    label: _('Extension', { count: 1 }),
    required: true,
  },
  errorVoicemail: {
    label: _('Voicemail', { count: 1 }),
    required: true,
  },
  noInputTarget: {
    label: _('No input target'),
    memoize: false,
  },
  errorTarget: {
    label: _('Error target'),
    memoize: false,
  },
};

const columns = [
  'name',
  'timeout',
  'allowExtensions',
  'noInputRouteType',
  'noInputTarget',
  'errorRouteType',
  'errorTarget',
];

const ivr: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AccountTreeIcon,
  link: '/doc/en/administration_portal/client/vpbx/routing_endpoints/ivrs.html',
  iden: 'Ivr',
  title: _('IVR', { count: 2 }),
  path: '/ivrs',
  toStr: (row: IvrPropertyList<string>) => `${row.name}`,
  properties,
  columns,
  defaultOrderBy: '',
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'IVRs',
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

export default ivr;
