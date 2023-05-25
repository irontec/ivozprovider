import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import SettingsIcon from '@mui/icons-material/Settings';

import User from '../User/User';

const Preferences: EntityInterface = {
  ...User,
  icon: SettingsIcon,
  localPath: '/my/preferences',
  acl: {
    ...User.acl,
    create: false,
  },
  Form: async () => {
    const module = await import('./Form');

    return module.default;
  },
  title: _('My Preferences', { count: 2 }),
};

export default Preferences;
