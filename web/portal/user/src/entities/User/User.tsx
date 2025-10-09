import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import AccountTreeIcon from '@mui/icons-material/AccountTree';

import { UserProperties, UserPropertyList } from './UserProperties';

const properties: UserProperties = {
  bossAssistant: {
    label: _('Boss / Assistant'),
  },
  doNotDisturb: {
    label: _('Do Not Disturb'),
  },
  email: {
    label: _('Email'),
  },
  id: {
    label: _('Id'),
  },
  isBoss: {
    label: _('Is Boss'),
  },
  lastname: {
    label: _('Last Name'),
  },
  maxCalls: {
    label: _('Max Calls'),
  },
  name: {
    label: _('Name'),
  },
  timezone: {
    label: _('Timezone', { count: 1 }),
  },
};

const columns = ['startTime', 'caller', 'duration', 'direction'];

const User: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AccountTreeIcon,
  iden: 'User',
  title: _('Profile', { count: 2 }),
  path: '/my/profile',
  localPath: '/profile',
  toStr: (row: UserPropertyList<string>) => `${row.id}`,
  properties,
  columns,
  defaultOrderBy: '',
  Form: async () => {
    const module = await import('./Form');

    return module.default;
  },
};

export default User;
