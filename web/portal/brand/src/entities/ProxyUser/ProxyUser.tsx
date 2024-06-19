import { EntityValue } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import SchemaIcon from '@mui/icons-material/Schema';

import {
  ProxyUserProperties,
  ProxyUserPropertyList,
} from './ProxyUserProperties';

const properties: ProxyUserProperties = {
  name: {
    label: _('Name'),
  },
  ip: {
    label: _('IP Address'),
  },
  advertisedIp: {
    label: _('Advertised IP Address'),
  },
};

const ProxyUser: EntityInterface = {
  ...defaultEntityBehavior,
  icon: SchemaIcon,
  link: '/doc/en/administration_portal/platform/infrastructure/proxy_users.html',
  iden: 'ProxyUser',
  title: _('Proxy User', { count: 2 }),
  path: '/proxy_users',
  toStr: (row: ProxyUserPropertyList<EntityValue>) => row.name as string,
  properties,
  columns: ['name', 'ip', 'advertisedIp'],
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'ProxyUsers',
  },
  selectOptions: async () => {
    const module = await import('./SelectOptions');

    return module.default;
  },
};

export default ProxyUser;
