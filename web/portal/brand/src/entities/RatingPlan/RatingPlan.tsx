import MoneyIcon from '@mui/icons-material/Money';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';
import Form from './Form';
import { foreignKeyGetter } from './ForeignKeyGetter';
import { RatingPlanProperties } from './RatingPlanProperties';
import foreignKeyResolver from './ForeignKeyResolver';

const timingFields = [
  'timeIn',
  'monday',
  'tuesday',
  'wednesday',
  'thursday',
  'friday',
  'saturday',
  'sunday',
];

const properties: RatingPlanProperties = {
  weight: {
    label: _('Weight'),
    default: 1,
    minimum: 1,
    helpText: _(
      `In case of colliding prefixes, destination rate with highest weight will be used.`
    ),
  },
  timingType: {
    label: _('Timing type'),
    enum: {
      always: _('Always'),
      custom: _('Custom'),
    },
    visualToggle: {
      always: {
        show: [],
        hide: timingFields,
      },
      custom: {
        show: timingFields,
        hide: [],
      },
    },
  },
  timeIn: {
    label: _('Time in'),
    default: '00:00:00',
    format: 'time',
  },
  monday: {
    label: _('Monday'),
    default: 1,
  },
  tuesday: {
    label: _('Tuesday'),
    default: 1,
  },
  wednesday: {
    label: _('Wednesday'),
    default: 1,
  },
  thursday: {
    label: _('Thursday'),
    default: 1,
  },
  friday: {
    label: _('Friday'),
    default: 1,
  },
  saturday: {
    label: _('Saturday'),
    default: 1,
  },
  sunday: {
    label: _('Sunday'),
    default: 1,
  },
  ratingPlanGroup: {
    label: _('Rating plan'),
  },
  destinationRateGroup: {
    label: _('Destination rate'),
  },
};

const RatingPlan: EntityInterface = {
  ...defaultEntityBehavior,
  icon: MoneyIcon,
  iden: 'RatingPlan',
  title: _('Destination rate', { count: 2 }),
  path: '/rating_plans',
  toStr: (row: any) => row.id,
  properties,
  columns: [
    'destinationRateGroup',
    'weight',
    'timingType',
    'timeIn',
    'monday',
    'tuesday',
    'wednesday',
    'thursday',
    'friday',
    'saturday',
    'sunday',
  ],
  selectOptions,
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default RatingPlan;
