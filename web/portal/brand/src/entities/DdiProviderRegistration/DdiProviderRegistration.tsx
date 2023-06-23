import { EntityValues } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import InsertLinkIcon from '@mui/icons-material/InsertLink';

import {
  DdiProviderRegistrationProperties,
  DdiProviderRegistrationPropertyList,
} from './DdiProviderRegistrationProperties';

const properties: DdiProviderRegistrationProperties = {
  username: {
    label: _('Username'),
    required: true,
  },
  domain: {
    label: _('Domain'),
    required: true,
  },
  realm: {
    label: _('Realm'),
    helpText: _('Leave empty to use the suggested default'),
    required: false,
  },
  authUsername: {
    label: _('Auth Username'),
    helpText: _("Only if it's different from the Username"),
    required: false,
  },
  authPassword: {
    label: _('Password'),
    format: 'password',
  },
  authProxy: {
    label: _('Registrar Server URI'),
    pattern: new RegExp('^sip:.*$|^sips:.*$'),
    helpText: _('Must start with sip or sips followed by colon'),
    required: false,
  },
  expires: {
    label: _('Expire'),
    default: 3600,
  },
  multiDdi: {
    label: _('Random Contact Username'),
    default: 1,
    enum: {
      '0': _('No'),
      '1': _('Yes'),
    },
    visualToggle: {
      '0': {
        show: ['contactUsername'],
        hide: [],
      },
      '1': {
        show: [],
        hide: ['contactUsername'],
      },
    },
  },
  contactUsername: {
    label: _('Contact Username'),
    helpText: _(
      'Is sent in the username of Contact header in generated REGISTER.'
    ),
  },
  ddiProvider: {
    label: _('DDI Provider', { count: 1 }),
  },
  status: {
    label: _('Status'),
  },
  statusIcon: {
    label: _('Status'),
    //@TODO IvozProvider_Klear_Ghost_RegisterStatus::getDdiProviderStatusIcon
  },
};

const DdiProviderRegistration: EntityInterface = {
  ...defaultEntityBehavior,
  icon: InsertLinkIcon,
  link: '/doc/en/administration_portal/brand/providers/ddi_providers.html#ddi-provider-registrations',
  iden: 'DdiProviderRegistration',
  title: _('DDI Provider Registration', { count: 2 }),
  path: '/ddi_provider_registrations',
  toStr: (row: DdiProviderRegistrationPropertyList<EntityValues>) =>
    `${row.id}`,
  properties,
  columns: ['username', 'domain', 'statusIcon'],
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

export default DdiProviderRegistration;
