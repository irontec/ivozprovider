import SwapCallsIcon from '@mui/icons-material/SwapCalls';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';
import Form from './Form';
import { foreignKeyGetter } from './ForeignKeyGetter';
import { CarrierProperties } from './CarrierProperties';
import foreignKeyResolver from './ForeignKeyResolver';
import Balance from './Field/Balance';

const properties: CarrierProperties = {
  description: {
    label: _('Description'),
  },
  name: {
    label: _('Name'),
  },
  externallyRated: {
    label: _('Externally rated'),
    default: 0,
    enum: {
      '0': _('No'),
      '1': _('Yes'),
    },
    visualToggle: {
      '0': {
        show: ['balance', 'calculateCost'],
        hide: [],
      },
      '1': {
        show: [],
        hide: ['balance', 'calculateCost', 'currency'],
      },
    },
  },
  calculateCost: {
    label: _('Calculate cost?'),
    default: 0,
    enum: {
      '0': _('No'),
      '1': _('Yes'),
    },
    visualToggle: {
      '0': {
        show: [],
        hide: ['balance', 'currency'],
      },
      '1': {
        show: ['balance', 'currency'],
        hide: [],
      },
    },
  },
  balance: {
    label: _('Balance'),
    component: Balance,
  },
  acd: {
    label: _('ACD'),
    helpText: _(
      "<a href='https://en.wikipedia.org/wiki/Average_call_duration' target='_blank'>Average Call Duration</a>"
    ),
    //@TODO IvozProvider_Klear_Ghost_Carriers::getAcd
  },
  asr: {
    label: _('ASR'),
    helpText: _(
      "<a href='https://en.wikipedia.org/wiki/Answer-seizure_ratio' target='_blank'>Answer-Seizure Ratio</a>"
    ),
    //@TODO IvozProvider_Klear_Ghost_Carriers::getAsr
  },
  statusIcon: {
    label: _('Status'),
    //@TODO IvozProvider_Klear_Ghost_CarrierServerStatus::getCarrierStatusIcon
  },
  mediaRelaySet: {
    label: _('Media relay Set'),
    default: '__null__',
    null: _(`Client's default`),
  },
  transformationRuleSet: {
    label: _('Numeric transformation'),
    default: 252,
  },
  currency: {
    label: _('Currency'),
    null: _('Default currency'),
    default: '__null__',
  },
  proxyTrunk: {
    label: _('Local socket'),
    helpText: _('Local address used in SIP signalling with this carrier.'),
  },
};

const Carrier: EntityInterface = {
  ...defaultEntityBehavior,
  icon: SwapCallsIcon,
  iden: 'Carrier',
  title: _('Carrier', { count: 2 }),
  path: '/carriers',
  toStr: (row: any) => row.name,
  properties,
  columns: [
    'name',
    'description',
    'transformationRuleSet',
    'balance',
    'proxyTrunk',
    'statusIcon',
  ],
  selectOptions,
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default Carrier;
