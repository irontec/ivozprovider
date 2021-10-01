import SettingsApplications from '@mui/icons-material/SettingsApplications';
import EntityInterface, { PropertiesList } from 'lib/entities/EntityInterface';
import _ from 'lib/services/translations/translate';
import defaultEntityBehavior from 'lib/entities/DefaultEntityBehavior';
import Form from './Form'
import RatingPlanGroup from '../RatingPlanGroup/RatingPlanGroup';
import entities from '../index';
import EntityService from 'lib/services/entity/EntityService';
import genericForeignKeyResolver from 'lib/services/api/genericForeigKeyResolver';

const properties: PropertiesList = {
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

async function foreignKeyResolver(data: any, entityService: EntityService) {

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
    foreignKeyResolver,
};

export default ratingProfile;