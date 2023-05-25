import { EntityValues } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import MeetingRoomIcon from '@mui/icons-material/MeetingRoom';

import {
  UsersAddressProperties,
  UsersAddressPropertyList,
} from './UsersAddressProperties';

const properties: UsersAddressProperties = {
  sourceAddress: {
    label: _('Authorized source', { count: 1 }),
    maxLength: 100,
    helpText: _(
      `CIDR notation (e.g. 8.8.8.0/24) or specific IP address (e.g. 8.8.8.8)`
    ),
  },
  description: {
    label: _('Description'),
    maxLength: 200,
  },
  company: {
    label: _('Client'),
  },
  ipAddr: {
    label: _('Ip addr'),
    maxLength: 50,
  },
  mask: {
    label: _('Mask'),
    default: 32,
  },
  port: {
    label: _('Port'),
    default: 0,
  },
  tag: {
    label: _('Tag'),
    maxLength: 64,
  },
};

const UsersAddress: EntityInterface = {
  ...defaultEntityBehavior,
  icon: MeetingRoomIcon,
  iden: 'UsersAddress',
  title: _('Authorized source', { count: 2 }),
  path: '/users_addresses',
  toStr: (row: UsersAddressPropertyList<EntityValues>) => `${row?.id}`,
  properties,
  selectOptions: async () => {
    const module = await import('./SelectOptions');

    return module.default;
  },
  foreignKeyResolver: async () => {
    const module = await import('./ForeignKeyResolver');

    return module.default;
  },
  foreignKeyGetter: async () => {
    const module = await import('./ForeignKeyGetter');

    return module.foreignKeyGetter;
  },
  Form: async () => {
    const module = await import('./Form');

    return module.default;
  },
};

export default UsersAddress;
