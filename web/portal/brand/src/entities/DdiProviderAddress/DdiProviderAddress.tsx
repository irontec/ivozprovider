import { EntityValues } from '@irontec-voip/ivoz-ui';
import defaultEntityBehavior from '@irontec-voip/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec-voip/ivoz-ui/entities/EntityInterface';
import _ from '@irontec-voip/ivoz-ui/services/translations/translate';
import DnsIcon from '@mui/icons-material/Dns';

import {
  DdiProviderAddressProperties,
  DdiProviderAddressPropertyList,
} from './DdiProviderAddressProperties';

const properties: DdiProviderAddressProperties = {
  ip: {
    label: _('IP address'),
    maxLength: 50,
    required: true,
  },
  description: {
    label: _('Description'),
    maxLength: 200,
  },
  ddiProvider: {
    label: _('DDI Provider', { count: 1 }),
  },
};

const DdiProviderAddress: EntityInterface = {
  ...defaultEntityBehavior,
  icon: DnsIcon,
  link: '/doc/en/administration_portal/brand/providers/ddi_providers.html#ddi-provider-addresses',
  iden: 'DdiProviderAddress',
  title: _('DDI Provider Address', { count: 2 }),
  path: '/ddi_provider_addresses',
  toStr: (row: DdiProviderAddressPropertyList<EntityValues>) => `${row.id}`,
  properties,
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'DDIProviderAddresses',
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

export default DdiProviderAddress;
