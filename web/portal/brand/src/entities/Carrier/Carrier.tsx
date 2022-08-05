import AccountTreeIcon from '@mui/icons-material/AccountTree';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';
import Form from './Form';
import { foreignKeyGetter } from './ForeignKeyGetter';
import { CarrierProperties } from './CarrierProperties';
import foreignKeyResolver from './ForeignKeyResolver';

const properties: CarrierProperties = {
  'description': {
    label: _('Description'),
  },
  'name': {
    label: _('Name'),
  },
  'externallyRated': {
    label: _('Externally Rated'),
  },
  'balance': {
    label: _('Balance'),
  },
  'calculateCost': {
    label: _('Calculate Cost'),
  },
  'id': {
    label: _('Id'),
  },
  'transformationRuleSet': {
    label: _('Transformation RuleSet'),
  },
  'currency': {
    label: _('Currency'),
  },
  'proxyTrunk': {
    label: _('Proxy Trunk'),
  },
};

const Carrier: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AccountTreeIcon,
  iden: 'Carrier',
  title: _('Carrier', { count: 2 }),
  path: '/Carriers',
  toStr: (row: any) => row.id,
  properties,
  selectOptions: (props, customProps) => { return selectOptions(props, customProps); },
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default Carrier;