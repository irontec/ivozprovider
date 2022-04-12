import GroupsIcon from '@mui/icons-material/Groups';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { HuntGroupsRelUserProperties } from './HuntGroupsRelUserProperties';
import Type from './Field/Target';
import Form from './Form';
import foreignKeyResolver from './foreignKeyResolver';

const properties: HuntGroupsRelUserProperties = {
  'huntGroup': {
    label: _('Hunt Group'),
  },
  'routeType': {
    label: _('Target type'),
    enum: {
      'user': _('User'),
      'number': _('Number'),
    },
    visualToggle: {
      'user': {
        show: ['user'],
        hide: ['numberCountry', 'numberValue'],
      },
      'number': {
        show: ['numberCountry', 'numberValue'],
        hide: ['user'],
      },
    },
  },
  'numberCountry': {
    label: _('Country'),
  },
  'numberValue': {
    label: _('Number'),
  },
  'user': {
    label: _('User'),
  },
  'timeoutTime': {
    label: _('Timeout time'),
  },
  'priority': {
    label: _('Priority'),
  },
  'target': {
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

const huntGroupsRelUser: EntityInterface = {
  ...defaultEntityBehavior,
  icon: GroupsIcon,
  iden: 'HuntGroupsRelUser',
  title: _('Hunt Group member', { count: 2 }),
  path: '/hunt_groups_rel_users',
  toStr: (row: any) => row.name,
  properties,
  columns,
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'HuntGroupsRelUsers',
  },
  foreignKeyResolver,
  Form,
};

export default huntGroupsRelUser;