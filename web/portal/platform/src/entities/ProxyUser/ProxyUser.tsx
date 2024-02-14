import { EntityValue, isEntityItem } from '@irontec/ivoz-ui';
import defaultEntityBehavior, {
  ChildDecorator as DefaultChildDecorator,
  marshaller as defaultMarshaller,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface, {
  ChildDecoratorType,
} from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import SchemaIcon from '@mui/icons-material/Schema';

import {
  ProxyUserProperties,
  ProxyUserPropertyList,
} from './ProxyUserProperties';

type marshallerType = typeof defaultMarshaller;
const marshaller: marshallerType = (row, properties, whitelist) => {
  if (row.advertisedIp === '') {
    row.advertisedIp = null;
  }

  return defaultMarshaller(row, properties, whitelist);
};

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

const ChildDecorator: ChildDecoratorType = (props) => {
  const { routeMapItem, row } = props;

  if (
    isEntityItem(routeMapItem) &&
    routeMapItem.entity.iden === ProxyUser.iden
  ) {
    const isDeletePath = routeMapItem.route === `${ProxyUser.path}/:id`;
    const allowDelete = row.id !== 1;
    if (isDeletePath && !allowDelete) {
      return null;
    }
  }

  return DefaultChildDecorator(props);
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
  ChildDecorator,
  selectOptions: async () => {
    const module = await import('./SelectOptions');

    return module.default;
  },
  Form: async () => {
    const module = await import('./Form');

    return module.default;
  },
  marshaller,
};

export default ProxyUser;
