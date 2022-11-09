import MeetingRoomIcon from '@mui/icons-material/MeetingRoom';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';
import Form from './Form';
import { foreignKeyGetter } from './ForeignKeyGetter';
import { UsersAddressProperties } from './UsersAddressProperties';
import foreignKeyResolver from './ForeignKeyResolver';

const properties: UsersAddressProperties = {
  sourceAddress: {
    label: _('Authorized source'),
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
  toStr: (row: any) => row.id,
  properties,
  selectOptions,
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default UsersAddress;
