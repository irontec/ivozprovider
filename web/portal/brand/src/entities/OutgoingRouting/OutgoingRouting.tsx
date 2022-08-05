import AccountTreeIcon from '@mui/icons-material/AccountTree';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';
import Form from './Form';
import { foreignKeyGetter } from './ForeignKeyGetter';
import { OutgoingRoutingProperties } from './OutgoingRoutingProperties';
import foreignKeyResolver from './ForeignKeyResolver';

const properties: OutgoingRoutingProperties = {
  'type': {
    label: _('Type'),
    enum: {
      'pattern' : _('Pattern'),
      'group' : _('Group'),
      'fax' : _('Fax'),
    },
  },
  'priority': {
    label: _('Priority'),
  },
  'weight': {
    label: _('Weight'),
  },
  'routingMode': {
    label: _('Routing Mode'),
    enum: {
      'static' : _('Static'),
      'lcr' : _('Lcr'),
      'block' : _('Block'),
    },
  },
  'prefix': {
    label: _('Prefix'),
  },
  'stopper': {
    label: _('Stopper'),
  },
  'forceClid': {
    label: _('Force Clid'),
  },
  'clid': {
    label: _('Clid'),
  },
  'id': {
    label: _('Id'),
  },
  'company': {
    label: _('Company'),
  },
  'carrier': {
    label: _('Carrier'),
  },
  'routingPattern': {
    label: _('Routing Pattern'),
  },
  'routingPatternGroup': {
    label: _('Routing PatternGroup'),
  },
  'routingTag': {
    label: _('Routing Tag'),
  },
  'clidCountry': {
    label: _('Clid Country'),
  },
  'carrierIds': {
    label: _('Carrier Ids'),
  },
};

const OutgoingRouting: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AccountTreeIcon,
  iden: 'OutgoingRouting',
  title: _('OutgoingRouting', { count: 2 }),
  path: '/OutgoingRoutings',
  toStr: (row: any) => row.id,
  properties,
  selectOptions: (props, customProps) => { return selectOptions(props, customProps); },
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default OutgoingRouting;