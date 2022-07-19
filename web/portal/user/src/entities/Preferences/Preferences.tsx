import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import SettingsIcon from '@mui/icons-material/Settings';
import User from 'entities/User/User';
import Form from './Form';

const Preferences: EntityInterface = {
  ...User,
  icon: SettingsIcon,
  localPath: '/my/preferences',
  acl: {
    ...User.acl,
    create: false,
  },
  Form,
  title: _('My Preferences', { count: 2 }),
};

export default Preferences;
