import PaymentsIcon from '@mui/icons-material/Payments';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';
import Form from './Form';
import { foreignKeyGetter } from './ForeignKeyGetter';
import { DestinationRateProperties } from './DestinationRateProperties';
import foreignKeyResolver from './ForeignKeyResolver';
import Cost from './Field/Cost';
import ConnectionFee from './Field/ConnectionFee';

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
    label: _('Destination'),
  },
};

const DestinationRate: EntityInterface = {
  ...defaultEntityBehavior,
  icon: PaymentsIcon,
  iden: 'DestinationRate',
  title: _('Rate', { count: 2 }),
  path: '/destination_rates',
  toStr: (row: any) => row.id,
  properties,
  columns: [
    'destination',
    'connectFee',
    'groupIntervalStart',
    'cost',
    'rateIncrement',
  ],
  selectOptions,
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default DestinationRate;
