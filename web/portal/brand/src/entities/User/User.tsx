import AccountTreeIcon from '@mui/icons-material/AccountTree';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';
import Form from './Form';
import { foreignKeyGetter } from './ForeignKeyGetter';
import { UserProperties } from './UserProperties';
import foreignKeyResolver from './ForeignKeyResolver';

const properties: UserProperties = {
  'name': {
    label: _('Name'),
  },
  'lastname': {
    label: _('Lastname'),
  },
  'email': {
    label: _('Email'),
  },
  'pass': {
    label: _('Pass'),
  },
  'doNotDisturb': {
    label: _('Do NotDisturb'),
  },
  'isBoss': {
    label: _('Is Boss'),
  },
  'active': {
    label: _('Active'),
  },
  'maxCalls': {
    label: _('Max Calls'),
  },
  'externalIpCalls': {
    label: _('External IpCalls'),
    enum: {
      '0' : _('0'),
      '1' : _('1'),
      '2' : _('2'),
      '3' : _('3'),
    },
  },
  'rejectCallMethod': {
    label: _('Reject CallMethod'),
    enum: {
      'rfc' : _('Rfc'),
      '486' : _('4 86'),
      '600' : _('6 00'),
    },
  },
  'multiContact': {
    label: _('Multi Contact'),
  },
  'gsQRCode': {
    label: _('Gs QRCode'),
  },
  'id': {
    label: _('Id'),
  },
  'company': {
    label: _('Company'),
  },
  'bossAssistant': {
    label: _('Boss Assistant'),
  },
  'transformationRuleSet': {
    label: _('Transformation RuleSet'),
  },
  'language': {
    label: _('Language'),
  },
  'terminal': {
    label: _('Terminal'),
  },
  'timezone': {
    label: _('Timezone'),
  },
  'outgoingDdi': {
    label: _('Outgoing Ddi'),
  },
  'oldPass': {
    label: _('Old Pass'),
  },
};

const User: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AccountTreeIcon,
  iden: 'User',
  title: _('User', { count: 2 }),
  path: '/Users',
  toStr: (row: any) => row.id,
  properties,
  selectOptions: (props, customProps) => { return selectOptions(props, customProps); },
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default User;