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
  ip: {
    label: _('Destination IP address'),
    pattern: new RegExp('^[.0-9]+$'),
    helpText: _('Leave empty to send to Host field'),
  },
  hostname: {
    label: _('Host'),
    helpText: _('Use address or hostname'),
  },
  port: {
    label: _('Port'),
    default: 5060,
  },
  uriScheme: {
    label: _('URI scheme'),
    default: 1,
    enum: {
      '1': _('sip'),
      '2': _('sips'),
    },
  },
  transport: {
    label: _('Transport'),
    default: 1,
    enum: {
      '1': _('UDP'),
      '2': _('TCP'),
      '3': _('TLS'),
    },
  },
  sendPAI: {
    label: _('Send PAI'),
    default: 1,
  },
  sendRPID: {
    label: _('Send RPID'),
  },
  authNeeded: {
    label: _('Auth Needed'),
    default: 'no',
    enum: {
      yes: _('Yes'),
      no: _('No'),
    },
    visualToggle: {
      yes: {
        show: ['authUser', 'authPassword'],
        hide: [],
      },
      no: {
        show: [],
        hide: ['authUser', 'authPassword'],
      },
    },
  },
  authUser: {
    label: _('Auth User'),
  },
  authPassword: {
    label: _('Auth Password'),
    f,
  },
  sipProxy: {
    label: _('SIP Proxy'),
    maxLength: 128,
    helpText: _("IP or domain name (port with ':')"),
  },
  outboundProxy: {
    label: _('Outbound Proxy'),
    maxLength: 128,
    helpText: _('Send to IP[:PORT] instead of SIP Proxy address'),
  },
  fromUser: {
    label: _('From user'),
    maxLength: 64,
    helpText: _('Use this instead in From header username'),
  },
  fromDomain: {
    label: _('From domain'),
    maxLength: 190,
    helpText: _('Use this instead in From header domain'),
  },
  statusIcon: {
    label: _('Status'),
    //@TODO IvozProvider_Klear_Ghost_CarrierServerStatus::getCarrierServerStatusIcon
  },
  carrier: {
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
  selectOptions,
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default CarrierServer;
