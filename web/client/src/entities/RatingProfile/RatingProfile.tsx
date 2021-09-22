import SettingsApplications from '@mui/icons-material/SettingsApplications';
import EntityInterface, { PropertiesList } from 'entities/EntityInterface';
import _ from 'services/Translations/translate';
import defaultEntityBehavior from 'entities/DefaultEntityBehavior';
import Form from './Form'
import RatingPlanGroup from '../RatingPlanGroup/RatingPlanGroup';
import entities from '../index';
import EntityService from 'services/Entity/EntityService';
import genericForeignKeyResolver from 'services/genericForeigKeyResolver';

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