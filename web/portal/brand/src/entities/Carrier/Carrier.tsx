import { EntityValues, isEntityItem } from '@irontec/ivoz-ui';
import defaultEntityBehavior, {
  ChildDecorator as DefaultChildDecorator,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface, {
  ChildDecoratorType,
} from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import SwapCallsIcon from '@mui/icons-material/SwapCalls';

import BalanceMovement from '../BalanceMovement/BalanceMovement';
import BalanceNotification from '../BalanceNotification/BalanceNotification';
import StatusIcon from '../CarrierServer/Field/StatusIcon';
import RatingProfile from '../RatingProfile/RatingProfile';
import { CarrierProperties, CarrierPropertyList } from './CarrierProperties';
import Balance from './Field/Balance';

const properties: CarrierProperties = {
  description: {
    label: _('Description'),
    required: false,
  },
  name: {
    label: _('Name'),
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
    helpText:
      "<a href='https://en.wikipedia.org/wiki/Average_call_duration' target='_blank'>Average Call Duration</a>",
    //@TODO IvozProvider_Klear_Ghost_Carriers::getAcd
  },
  asr: {
    label: _('ASR'),
    helpText:
      "<a href='https://en.wikipedia.org/wiki/Answer-seizure_ratio' target='_blank'>Answer-Seizure Ratio</a>",
    //@TODO IvozProvider_Klear_Ghost_Carriers::getAsr
  },
  statusIcon: {
    label: _('Status'),
    component: StatusIcon,
  },
  mediaRelaySet: {
    label: _('Media relay Set'),
    default: '__null__',
    null: _(`Client's default`),
  },
  transformationRuleSet: {
    label: _('Numeric transformation', { count: 1 }),
    default: 252,
  },
  currency: {
    label: _('Currency', { count: 1 }),
    null: _('Default currency'),
    default: '__null__',
  },
  proxyTrunk: {
    label: _('Local socket'),
    helpText: _('Local address used in SIP signalling with this carrier.'),
  },
};

export const ChildDecorator: ChildDecoratorType = (props) => {
  const { routeMapItem, row } = props;

  if (row.calculateCost === false && isEntityItem(routeMapItem)) {
    const actionsToHide = [
      BalanceMovement.iden,
      BalanceNotification.iden,
      RatingProfile.iden,
    ];

    if (actionsToHide.includes(routeMapItem.entity.iden)) {
      return null;
    }
  }

  return DefaultChildDecorator(props);
};

const Carrier: EntityInterface = {
  ...defaultEntityBehavior,
  icon: SwapCallsIcon,
  iden: 'Carrier',
  title: _('Carrier', { count: 2 }),
  path: '/carriers',
  toStr: (row: CarrierPropertyList<EntityValues>) => `${row.name}`,
  properties,
  columns: [
    'name',
    'description',
    'transformationRuleSet',
    'balance',
    'proxyTrunk',
    'statusIcon',
  ],
  ChildDecorator,
  selectOptions: async () => {
    const module = await import('./SelectOptions');

    return module.default;
  },
  foreignKeyResolver: async () => {
    const module = await import('./ForeignKeyResolver');

    return module.default;
  },
  foreignKeyGetter: async () => {
    const module = await import('./ForeignKeyGetter');

    return module.foreignKeyGetter;
  },
  Form: async () => {
    const module = await import('./Form');

    return module.default;
  },
};

export default Carrier;
