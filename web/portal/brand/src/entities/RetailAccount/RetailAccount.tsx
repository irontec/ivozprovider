import AccountTreeIcon from '@mui/icons-material/AccountTree';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';
import Form from './Form';
import { foreignKeyGetter } from './ForeignKeyGetter';
import { RetailAccountProperties } from './RetailAccountProperties';
import foreignKeyResolver from './ForeignKeyResolver';

const properties: RetailAccountProperties = {
  'name': {
    label: _('Name'),
  },
  'description': {
    label: _('Description'),
  },
  'transport': {
    label: _('Transport'),
    enum: {
      'udp' : _('Udp'),
      'tcp' : _('Tcp'),
      'tls' : _('Tls'),
    },
  },
  'ip': {
    label: _('Ip'),
  },
  'port': {
    label: _('Port'),
  },
  'password': {
    label: _('Password'),
  },
  'fromDomain': {
    label: _('From Domain'),
  },
  'directConnectivity': {
    label: _('Direct Connectivity'),
    enum: {
      'yes' : _('Yes'),
      'no' : _('No'),
    },
  },
  'ddiIn': {
    label: _('Ddi In'),
    enum: {
      'yes' : _('Yes'),
      'no' : _('No'),
    },
  },
  't38Passthrough': {
    label: _('T 38Passthrough'),
    enum: {
      'yes' : _('Yes'),
      'no' : _('No'),
    },
  },
  'id': {
    label: _('Id'),
  },
  'company': {
    label: _('Company'),
  },
  'transformationRuleSet': {
    label: _('Transformation RuleSet'),
  },
  'outgoingDdi': {
    label: _('Outgoing Ddi'),
  },
  'domainName': {
    label: _('Domain Name'),
  },
  'status': {
    label: _('Status'),
  },
};

const RetailAccount: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AccountTreeIcon,
  iden: 'RetailAccount',
  title: _('RetailAccount', { count: 2 }),
  path: '/RetailAccounts',
  toStr: (row: any) => row.id,
  properties,
  selectOptions: (props, customProps) => { return selectOptions(props, customProps); },
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default RetailAccount;