import PriceChangeIcon from '@mui/icons-material/PriceChange';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';
import Form from './Form';
import { foreignKeyGetter } from './ForeignKeyGetter';
import { RatingProfileProperties } from './RatingProfileProperties';
import foreignKeyResolver from './ForeignKeyResolver';

const properties: RatingProfileProperties = {
  activationTime: {
    label: _('Activation time'),
    format: 'date-time',
  },
  company: {
    label: _('Client'),
    null: _('Unassigned'),
  },
  carrier: {
    label: _('Carrier', { count: 1 }),
  },
  ratingPlanGroup: {
    label: _('Rating plan'),
  },
  routingTag: {
    label: _('Routing Tag', { count: 1 }),
    null: _('No routing tag'),
  },
};

const RatingProfile: EntityInterface = {
  ...defaultEntityBehavior,
  icon: PriceChangeIcon,
  iden: 'RatingProfile',
  title: _('Rating Profile', { count: 2 }),
  path: '/rating_profiles',
  toStr: (row: any) => row.id,
  properties,
  columns: ['activationTime', 'ratingPlanGroup'],
  selectOptions,
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default RatingProfile;
