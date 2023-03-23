import CallMissedOutgoingIcon from '@mui/icons-material/CallMissedOutgoing';
import EntityInterface, {
  ChildDecoratorType,
} from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior, {
  ChildDecorator as DefaultChildDecorator,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import {
  ProxyTrunkProperties,
  ProxyTrunkPropertyList,
} from './ProxyTrunkProperties';
import { EntityValue, isEntityItem } from '@irontec/ivoz-ui';
import selectOptions from './SelectOptions';
import Form from './Form';

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
  selectOptions,
  ChildDecorator,
  Form,
};

export default ProxyTrunk;
