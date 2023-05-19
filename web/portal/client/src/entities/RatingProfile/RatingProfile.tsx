import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import SettingsApplications from '@mui/icons-material/SettingsApplications';

import { RatingProfileProperties } from './RatingProfileProperties';

const properties: RatingProfileProperties = {
  activationTime: {
    label: _('Activation time'),
  },
  ratingPlanGroup: {
    label: _('Rating plan'),
  },
  routingTag: {
    label: _('Routing Tag'),
    null: _('No routing tag'),
  },
};

const ratingProfile: EntityInterface = {
  ...defaultEntityBehavior,
  icon: SettingsApplications,
  iden: 'RatingProfile',
  title: _('Rating profile', { count: 2 }),
  path: '/rating_profiles',
  properties,
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'RatingProfiles',
  },
  foreignKeyResolver: async () => {
    const module = await import('./ForeignKeyResolver');

    return module.default;
  },
  Form: async () => {
    const module = await import('./Form');

    return module.default;
  },
};

export default ratingProfile;
