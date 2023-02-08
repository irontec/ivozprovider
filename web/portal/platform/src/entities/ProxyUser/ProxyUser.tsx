import SchemaIcon from '@mui/icons-material/Schema';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';
import Form from './Form';
import {
  ProxyUserProperties,
  ProxyUserPropertyList,
} from './ProxyUserProperties';
import { EntityValue } from '@irontec/ivoz-ui';

const properties: ProxyUserProperties = {
  name: {
    label: _('Name'),
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
  selectOptions,
  Form,
};

export default ProxyUser;
