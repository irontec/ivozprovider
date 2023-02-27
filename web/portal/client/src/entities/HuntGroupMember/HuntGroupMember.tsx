import GroupsIcon from '@mui/icons-material/Groups';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { HuntGroupMemberProperties } from './HuntGroupMemberProperties';
import Type from './Field/Target';
import Form from './Form';
import foreignKeyResolver from './foreignKeyResolver';

const properties: HuntGroupMemberProperties = {
  huntGroup: {
    label: _('Hunt Group'),
  },
  routeType: {
    label: _('Target type'),
    enum: {
      user: _('User'),
      number: _('Number'),
    },
    visualToggle: {
      user: {
        show: ['user'],
        hide: ['numberCountry', 'numberValue'],
      },
      number: {
        show: ['numberCountry', 'numberValue'],
        hide: ['user'],
      },
    },
  },
  numberCountry: {
    label: _('Country'),
    required: true,
  },
  numberValue: {
    label: _('Number'),
    required: true,
  },
  user: {
    label: _('User'),
  },
  timeoutTime: {
    label: _('Timeout time'),
  },
  priority: {
    label: _('Priority'),
  },
  target: {
    label: _('Target'),
    component: Type,
    readOnly: true,
  },
};

const columns = [
  'target',
  'huntGroup',
  'routeType',
  'numberCountry',
  'numberValue',
  'timeoutTime',
  'priority',
];

const huntGroupMember: EntityInterface = {
  ...defaultEntityBehavior,
  icon: GroupsIcon,
  iden: 'HuntGroupMember',
  title: _('Hunt Group member', { count: 2 }),
  path: '/hunt_group_members',
  toStr: (row: any) => row.name,
  properties,
  columns,
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'HuntGroupMembers',
  },
  foreignKeyResolver,
  Form,
};

export default huntGroupMember;
