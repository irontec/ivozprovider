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
    readOnly: true,
  },
  ip: {
    label: _('IP'),
  },
};

const ProxyUser: EntityInterface = {
  ...defaultEntityBehavior,
  icon: SchemaIcon,
  iden: 'ProxyUser',
  title: _('Proxy User', { count: 2 }),
  path: '/proxy_users',
  toStr: (row: ProxyUserPropertyList<EntityValue>) => row.name as string,
  properties,
  columns: ['name', 'ip'],
  selectOptions: async () => {
    const module = await import('./SelectOptions');

    return module.default;
  },
  Form: async () => {
    const module = await import('./Form');

    return module.default;
  },
};

export default ProxyUser;
