import { MarshallerValues, PartialPropertyList } from '@irontec/ivoz-ui';
import EntityInterface, {
  EntityValidator,
} from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import AccountCircleIcon from '@mui/icons-material/AccountCircle';
import User from 'entities/User/User';
import Form from './Form';

const validator: EntityValidator = (values, properties, visualToggle) => {
  const response = User.validator(values, properties, visualToggle);
  const changePassword = values?.changePassword;
  const password = values?.pass;
  const repeatPassword = values?.repeatPass;

  if (!changePassword) {
    return response;
  }

  if (password !== repeatPassword) {
    response['repeatPass'] = _("Passwords doesn't match.");
  }

  return response;
};

const unmarshaller = (
  row: MarshallerValues,
  properties: PartialPropertyList
): MarshallerValues => {
  const response = User.unmarshaller(row, properties);
  response.changePassword = 0;
  response.oldPass = '';
  response.pass = '';
  response.repeatPass = '';

  return response;
};

const marshaller = (
  row: MarshallerValues,
  properties: PartialPropertyList
): MarshallerValues => {
  const response = User.marshaller(row, properties);
  const changePassword = response.changePassword;

  if (!changePassword) {
    delete response.oldPass;
    delete response.pass;
    delete response.repeatPass;
  }

  return response;
};

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
      visualToggle: {
        0: {
          show: [''],
          hide: ['repeatPass', 'pass', 'oldPass'],
        },
        1: {
          show: ['repeatPass', 'pass', 'oldPass'],
          hide: [''],
        },
      },
    },
    pass: {
      label: _('Password'),
      format: 'password',
      required: true,
    },
    oldPass: {
      label: _('Old password'),
      format: 'password',
      required: true,
    },
    repeatPass: {
      label: _('Repeat password'),
      type: 'string',
      format: 'password',
      required: true,
    },
  },
  validator,
  Form,
  unmarshaller,
  marshaller,
  title: _('My Account', { count: 2 }),
};

export default Account;
