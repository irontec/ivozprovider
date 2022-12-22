import AccountTreeIcon from '@mui/icons-material/AccountTree';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';
import Form from './Form';
import { foreignKeyGetter } from './ForeignKeyGetter';
import { FriendProperties } from './FriendProperties';
import foreignKeyResolver from './ForeignKeyResolver';

const properties: FriendProperties = {
  name: {
    label: _('Name'),
  },
  description: {
    label: _('Description'),
  },
  transport: {
    label: _('Transport'),
    enum: {
      udp: _('Udp'),
      tcp: _('Tcp'),
      tls: _('Tls'),
    },
  },
  ip: {
    label: _('Ip'),
  },
  port: {
    label: _('Port'),
  },
  password: {
    label: _('Password'),
  },
  priority: {
    label: _('Priority'),
  },
  allow: {
    label: _('Allow'),
  },
  fromUser: {
    label: _('From User'),
  },
  fromDomain: {
    label: _('From Domain'),
  },
  directConnectivity: {
    label: _('Direct Connectivity'),
    enum: {
      yes: _('Yes'),
      no: _('No'),
      intervpbx: _('Intervpbx'),
    },
  },
  ddiIn: {
    label: _('Ddi In'),
    enum: {
      yes: _('Yes'),
      no: _('No'),
    },
  },
  t38Passthrough: {
    label: _('T 38Passthrough'),
    enum: {
      yes: _('Yes'),
      no: _('No'),
    },
  },
  id: {
    label: _('Id'),
  },
  company: {
    label: _('Company'),
  },
  transformationRuleSet: {
    label: _('Transformation RuleSet'),
  },
  outgoingDdi: {
    label: _('Outgoing Ddi'),
  },
  language: {
    label: _('Language'),
  },
  interCompany: {
    label: _('Inter Company'),
  },
  domain: {
    label: _('Domain'),
  },
  domainName: {
    label: _('Domain Name'),
  },
  status: {
    label: _('Status'),
  },
};

const Friend: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AccountTreeIcon,
  iden: 'Friend',
  title: _('Friend', { count: 2 }),
  path: '/friends',
  toStr: (row: any) => row.name,
  properties,
  selectOptions,
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default Friend;
