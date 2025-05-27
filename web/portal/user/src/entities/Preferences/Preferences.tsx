import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import ManageAccountsIcon from '@mui/icons-material/ManageAccounts';

import User from '../User/User';

const Preferences: EntityInterface = {
  ...User,
  icon: ManageAccountsIcon,
  localPath: '/my/preferences',
  acl: {
    ...User.acl,
    create: false,
  },
  Form: async () => {
    const module = await import('./Form');

    return module.default;
  },
  title: _('My Preferences'),
};

export default Preferences;
