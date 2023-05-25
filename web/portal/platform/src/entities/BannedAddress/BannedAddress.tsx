import { EntityValue } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import RemoveModeratorIcon from '@mui/icons-material/RemoveModerator';

import {
  BannedAddressProperties,
  BannedAddressPropertyList,
} from './BannedAddressProperties';

const properties: BannedAddressProperties = {
  ip: {
    label: _('IP address'),
  },
  lastTimeBanned: {
    label: _('Last time banned'),
  },
};

const BannedAddress: EntityInterface = {
  ...defaultEntityBehavior,
  icon: RemoveModeratorIcon,
  iden: 'BannedAddress',
  title: _('Antiflood banned IP', { count: 2 }),
  path: '/banned_addresses',
  acl: {
    ...defaultEntityBehavior.acl,
    detail: false,
  },
  toStr: (row: BannedAddressPropertyList<EntityValue>) => row.ip as string,
  properties,
  columns: ['ip', 'lastTimeBanned'],
};

export default BannedAddress;
