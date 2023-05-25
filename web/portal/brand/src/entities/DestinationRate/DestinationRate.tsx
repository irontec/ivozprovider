import { EntityValues } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import PaymentsIcon from '@mui/icons-material/Payments';

import {
  DestinationRateProperties,
  DestinationRatePropertyList,
} from './DestinationRateProperties';
import ConnectionFee from './Field/ConnectionFee';
import Cost from './Field/Cost';

const properties: DestinationRateProperties = {
  cost: {
    label: _('Per minute rate'),
    pattern: new RegExp(`/^[0-9]{1,6}[.]{0,1}[0-9]*$/`),
    default: '0.0000',
    helpText: _(`Use point as decimal delimiter - e.g. 0.02`),
    component: Cost,
  },
  costCurrency: {
    label: _('Per minute rate'),
  },
  connectFee: {
    label: _('Connect Fee'),
    pattern: new RegExp(`/^[0-9]{1,6}[.]{0,1}[0-9]*$/`),
    default: '0.0000',
    helpText: _(`Use point as decimal delimiter - e.g. 0.02`),
    component: ConnectionFee,
  },
  connectFeeCurrency: {
    label: _('Connection fee'),
  },
  rateIncrement: {
    label: _('Charge period'),
    default: 1,
    minimum: 1,
    helpText: _(`Interval in seconds to increase call cost.`),
  },
  groupIntervalStart: {
    label: _('Interval start'),
    default: 0,
    minimum: 0,
    helpText: _(
      `Seconds from the beginning of the call when this rate will be activated.`
    ),
  },
  destinationRateGroup: {
    label: _('Destination rate group'),
  },
  destination: {
    label: _('Destination', { count: 1 }),
  },
  currencySymbol: {
    label: _('Currency', { count: 1 }),
  },
};

const DestinationRate: EntityInterface = {
  ...defaultEntityBehavior,
  icon: PaymentsIcon,
  iden: 'DestinationRate',
  title: _('Rate', { count: 2 }),
  path: '/destination_rates',
  toStr: (row: DestinationRatePropertyList<EntityValues>) => `${row.id}`,
  properties,
  columns: [
    'destination',
    'connectFee',
    'groupIntervalStart',
    'cost',
    'rateIncrement',
    'currencySymbol',
  ],
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

export default DestinationRate;
