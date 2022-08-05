import AccountTreeIcon from '@mui/icons-material/AccountTree';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';
import Form from './Form';
import { foreignKeyGetter } from './ForeignKeyGetter';
import { ResidentialDeviceProperties } from './ResidentialDeviceProperties';
import foreignKeyResolver from './ForeignKeyResolver';

const properties: ResidentialDeviceProperties = {
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
  'allow': {
    label: _('Allow'),
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
  'maxCalls': {
    label: _('Max Calls'),
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
  'language': {
    label: _('Language'),
  },
  'domainName': {
    label: _('Domain Name'),
  },
  'status': {
    label: _('Status'),
  },
};

const ResidentialDevice: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AccountTreeIcon,
  iden: 'ResidentialDevice',
  title: _('ResidentialDevice', { count: 2 }),
  path: '/ResidentialDevices',
  toStr: (row: any) => row.id,
  properties,
  selectOptions: (props, customProps) => { return selectOptions(props, customProps); },
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default ResidentialDevice;