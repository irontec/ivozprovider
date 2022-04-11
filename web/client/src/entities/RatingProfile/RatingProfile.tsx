import SettingsApplications from '@mui/icons-material/SettingsApplications';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import Form from './Form';
import { foreignKeyGetter } from './foreignKeyGetter';
import { RatingProfileProperties } from './RatingProfileProperties';
import foreignKeyResolver from './foreignKeyResolver';

const properties: RatingProfileProperties = {
    'activationTime': {
        label: _('Activation time'),
    },
    'ratingPlanGroup': {
        label: _('Rating plan'),
    },
    'routingTag': {
        label: _('Routing Tag'),
        null: _("No routing tag"),
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
    Form,
    foreignKeyGetter,
    foreignKeyResolver,
};

export default ratingProfile;