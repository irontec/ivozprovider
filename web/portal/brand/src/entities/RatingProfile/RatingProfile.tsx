import { EntityValues } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import PriceChangeIcon from '@mui/icons-material/PriceChange';

import {
  RatingProfileProperties,
  RatingProfilePropertyList,
} from './RatingProfileProperties';

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
  toStr: (row: RatingProfilePropertyList<EntityValues>) => `${row.id}`,
  properties,
  columns: ['activationTime', 'ratingPlanGroup'],
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

export default RatingProfile;
