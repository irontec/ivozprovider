import { EntityValue } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import AccountTreeIcon from '@mui/icons-material/AccountTree';

import {
  DdiProviderProperties,
  DdiProviderPropertyList,
} from './DdiProviderProperties';

const properties: DdiProviderProperties = {
  description: {
    label: _('Description'),
  },
  name: {
    label: _('Name'),
  },
  id: {
    label: _('Id'),
  },
  brand: {
    label: _('Brand'),
  },
  proxyTrunk: {
    label: _('Proxy Trunk'),
  },
  mediaRelaySets: {
    label: _('Media RelaySets'),
  },
};

const DdiProvider: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AccountTreeIcon,
  iden: 'DdiProvider',
  title: _('DdiProvider', { count: 2 }),
  path: '/DdiProviders',
  toStr: (row: DdiProviderPropertyList<EntityValue>) => row.name as string,
  properties,
};

export default DdiProvider;
