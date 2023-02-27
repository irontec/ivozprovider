import CallMissedOutgoingIcon from '@mui/icons-material/CallMissedOutgoing';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import {
  ProxyTrunkProperties,
  ProxyTrunkPropertyList,
} from './ProxyTrunkProperties';
import { EntityValue } from '@irontec/ivoz-ui';
import selectOptions from './SelectOptions';
import Form from './Form';

const properties: ProxyTrunkProperties = {
  name: {
    label: _('Name'),
    readOnly: true,
  },
  ip: {
    label: _('IP'),
  },
  id: {
    label: _('Id'),
  },
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
  Form,
};

export default ProxyTrunk;
