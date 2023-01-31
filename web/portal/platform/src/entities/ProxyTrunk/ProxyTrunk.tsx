import AccountTreeIcon from '@mui/icons-material/AccountTree';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';
import {
  ProxyTrunkProperties,
  ProxyTrunkPropertyList,
} from './ProxyTrunkProperties';
import { EntityValue } from '@irontec/ivoz-ui';

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

const ProxyTrunk: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AccountTreeIcon,
  iden: 'ProxyTrunk',
  title: _('Proxy Trunks', { count: 2 }),
  path: '/proxy_trunks',
  toStr: (row: ProxyTrunkPropertyList<EntityValue>) => row.ip as string,
  properties,
  selectOptions,
};

export default ProxyTrunk;
