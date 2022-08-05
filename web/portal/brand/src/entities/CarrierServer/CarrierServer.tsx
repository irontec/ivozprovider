import AccountTreeIcon from '@mui/icons-material/AccountTree';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';
import Form from './Form';
import { foreignKeyGetter } from './ForeignKeyGetter';
import { CarrierServerProperties } from './CarrierServerProperties';
import foreignKeyResolver from './ForeignKeyResolver';

const properties: CarrierServerProperties = {
  'ip': {
    label: _('Ip'),
  },
  'hostname': {
    label: _('Hostname'),
  },
  'port': {
    label: _('Port'),
  },
  'uriScheme': {
    label: _('Uri Scheme'),
  },
  'transport': {
    label: _('Transport'),
  },
  'sendPAI': {
    label: _('Send PAI'),
  },
  'sendRPID': {
    label: _('Send RPID'),
  },
  'authNeeded': {
    label: _('Auth Needed'),
  },
  'authUser': {
    label: _('Auth User'),
  },
  'authPassword': {
    label: _('Auth Password'),
  },
  'sipProxy': {
    label: _('Sip Proxy'),
  },
  'outboundProxy': {
    label: _('Outbound Proxy'),
  },
  'fromUser': {
    label: _('From User'),
  },
  'fromDomain': {
    label: _('From Domain'),
  },
  'id': {
    label: _('Id'),
  },
  'carrier': {
    label: _('Carrier'),
  },
};

const CarrierServer: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AccountTreeIcon,
  iden: 'CarrierServer',
  title: _('CarrierServer', { count: 2 }),
  path: '/CarrierServers',
  toStr: (row: any) => row.id,
  properties,
  selectOptions: (props, customProps) => { return selectOptions(props, customProps); },
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default CarrierServer;