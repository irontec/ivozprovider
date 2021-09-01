import SettingsApplications from '@material-ui/icons/SettingsApplications';
import EntityInterface, { PropertiesList } from 'entities/EntityInterface';
import _ from 'services/Translations/translate';
import defaultEntityBehavior from 'entities/DefaultEntityBehavior';
import Form from './Form'
import RatingPlanGroup from '../RatingPlanGroup/RatingPlanGroup';
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
        //@todo fetch routingTag value
    },
};

async function foreignKeyResolver(data: any, entityService: EntityService) {

    const promises = [];

    promises.push(
        genericForeignKeyResolver(
            data,
            'ratingPlanGroup',
            RatingPlanGroup.path,
            RatingPlanGroup.toStr,
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