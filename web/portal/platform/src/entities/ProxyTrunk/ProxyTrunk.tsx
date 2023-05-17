import { EntityValue, isEntityItem } from '@irontec/ivoz-ui';
import defaultEntityBehavior, {
  ChildDecorator as DefaultChildDecorator,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface, {
  ChildDecoratorType,
} from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import CallMissedOutgoingIcon from '@mui/icons-material/CallMissedOutgoing';

import {
  ProxyTrunkProperties,
  ProxyTrunkPropertyList,
} from './ProxyTrunkProperties';

const properties: ProxyTrunkProperties = {
  name: {
    label: _('Name'),
  },
  ip: {
    label: _('IP'),
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
  },
  icon: CallMissedOutgoingIcon,
  iden: 'ProxyTrunk',
  title: _('Proxy Trunk', { count: 2 }),
  path: '/proxy_trunks',
  toStr: (row: ProxyTrunkPropertyList<EntityValue>) =>
    `${row.name} (${row.ip})`,
  columns: ['name', 'ip'],
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
};

export default ProxyTrunk;
