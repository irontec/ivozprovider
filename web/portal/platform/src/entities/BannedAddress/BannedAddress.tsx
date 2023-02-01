import RemoveModeratorIcon from '@mui/icons-material/RemoveModerator';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import {
  BannedAddressProperties,
  BannedAddressPropertyList,
} from './BannedAddressProperties';
import { EntityValue } from '@irontec/ivoz-ui';

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
  toStr: (row: BannedAddressPropertyList<EntityValue>) => row.ip as string,
  properties,
  columns: ['ip', 'lastTimeBanned'],
};

export default BannedAddress;
