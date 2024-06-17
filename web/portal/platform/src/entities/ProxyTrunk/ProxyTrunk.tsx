import { EntityValue, isEntityItem } from '@irontec-voip/ivoz-ui';
import defaultEntityBehavior, {
  ChildDecorator as DefaultChildDecorator,
  marshaller as defaultMarshaller,
} from '@irontec-voip/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface, {
  ChildDecoratorType,
} from '@irontec-voip/ivoz-ui/entities/EntityInterface';
import _ from '@irontec-voip/ivoz-ui/services/translations/translate';
import CallMissedOutgoingIcon from '@mui/icons-material/CallMissedOutgoing';

import {
  ProxyTrunkProperties,
  ProxyTrunkPropertyList,
} from './ProxyTrunkProperties';

type marshallerType = typeof defaultMarshaller;
const marshaller: marshallerType = (row, properties, whitelist) => {
  if (row.advertisedIp === '') {
    row.advertisedIp = null;
  }

  return defaultMarshaller(row, properties, whitelist);
};

const properties: ProxyTrunkProperties = {
  name: {
    label: _('Name'),
  },
  ip: {
    label: _('IP Address'),
  },
  advertisedIp: {
    label: _('Advertised IP Address'),
  },
  id: {
    label: _('Id'),
  },
};
const ChildDecorator: ChildDecoratorType = (props) => {
  const { routeMapItem, row } = props;

  if (
    isEntityItem(routeMapItem) &&
    routeMapItem.entity.iden === ProxyTrunk.iden
  ) {
    const isDeletePath = routeMapItem.route === `${ProxyTrunk.path}/:id`;
    const allowDelete = row.id !== 1;
    if (isDeletePath && !allowDelete) {
      return null;
    }
  }

  return DefaultChildDecorator(props);
};

const ProxyTrunk: EntityInterface = {
  ...defaultEntityBehavior,
  acl: {
    ...defaultEntityBehavior.acl,
    create: true,
    iden: 'ProxyTrunks',
  },
  icon: CallMissedOutgoingIcon,
  link: '/doc/en/administration_portal/platform/infrastructure/proxy_trunks.html',
  iden: 'ProxyTrunk',
  title: _('Proxy Trunk', { count: 2 }),
  path: '/proxy_trunks',
  toStr: (row: ProxyTrunkPropertyList<EntityValue>) => {
    const ip = row.advertisedIp ? row.advertisedIp : row.ip;

    const label = `${row.name} (${ip})`;

    return label;
  },
  columns: ['name', 'ip', 'advertisedIp'],
  properties,
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

export default ProxyTrunk;
