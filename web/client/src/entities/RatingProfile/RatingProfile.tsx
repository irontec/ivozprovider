import SettingsApplications from '@mui/icons-material/SettingsApplications';
import EntityInterface from 'lib/entities/EntityInterface';
import _ from 'lib/services/translations/translate';
import defaultEntityBehavior from 'lib/entities/DefaultEntityBehavior';
import Form from './Form';
import { foreignKeyGetter } from './useFkChoices';
import RatingPlanGroup from '../RatingPlanGroup/RatingPlanGroup';
import entities from '../index';
import genericForeignKeyResolver from 'lib/services/api/genericForeigKeyResolver';
import { RatingProfileProperties, RatingProfilePropertiesList } from './RatingProfileProperties';

const properties: RatingProfileProperties = {
    'activationTime': {
        label: _('Activation time'),
    },
    'ratingPlanGroup': {
        label: _('Rating plan'),
    },
    'routingTag': {
        label: _('Routing Tag'),
    },
};

async function foreignKeyResolver(data: RatingProfilePropertiesList): Promise<RatingProfilePropertiesList> {

    const promises = [];

    const { RoutingTag } = entities;

    promises.push(
        genericForeignKeyResolver(
            data,
            'ratingPlanGroup',
            RatingPlanGroup.path,
            RatingPlanGroup.toStr,
            false
        )
    );

    promises.push(
        genericForeignKeyResolver(
            data,
            'routingTag',
            RoutingTag.path,
            RoutingTag.toStr,
            false
        )
    );

    await Promise.all(promises);

    return data;
}

const ratingProfile: EntityInterface = {
    ...defaultEntityBehavior,
    icon: <SettingsApplications />,
    iden: 'RatingProfile',
    title: _('Rating profile', { count: 2 }),
    path: '/rating_profiles',
    properties,
    Form,
    foreignKeyGetter,
    foreignKeyResolver,
};

export default ratingProfile;