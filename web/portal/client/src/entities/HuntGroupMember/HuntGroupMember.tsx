import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import Groups3Icon from '@mui/icons-material/Groups3';

import Type from './Field/Target';
import {
  HuntGroupMemberProperties,
  HuntGroupMemberPropertyList,
} from './HuntGroupMemberProperties';

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
    required: true,
  },
  priority: {
    label: _('Priority'),
    required: true,
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
  icon: Groups3Icon,
  iden: 'HuntGroupMember',
  title: _('Hunt Group member', { count: 2 }),
  path: '/hunt_group_members',
  toStr: (row: HuntGroupMemberPropertyList<string>) => `${row.id}`,
  properties,
  columns,
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'HuntGroupMembers',
  },
  foreignKeyResolver: async () => {
    const module = await import('./ForeignKeyResolver');

    return module.default;
  },
  Form: async () => {
    const module = await import('./Form');

    return module.default;
  },
};

export default huntGroupMember;
