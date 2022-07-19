import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import User from 'entities/User/User';
import AccountCircleIcon from '@mui/icons-material/AccountCircle';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import Form from './Form';

const Account: EntityInterface = {
  ...User,
  icon: AccountCircleIcon,
  localPath: '/my/account',
  acl: {
    ...User.acl,
    create: false,
  },
  properties: {
    ...User.properties,
    changePassword: {
      label: _('Change Password'),
      type: 'boolean',
    },
    repeatPass: {
      label: _('Repeat Password'),
      type: 'string',
    },
  },
  Form,
  // TODO: Validator function for password validation.
  title: _('My Account', { count: 2 }),
};

export default Account;
