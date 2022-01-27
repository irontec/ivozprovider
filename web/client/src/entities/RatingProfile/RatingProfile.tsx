import SettingsApplications from '@mui/icons-material/SettingsApplications';
import EntityInterface, { foreignKeyResolverType } from 'lib/entities/EntityInterface';
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

const foreignKeyResolver: foreignKeyResolverType = async function(
    { data, cancelToken }
): Promise<RatingProfilePropertiesList> {

    const promises = [];

    const { RoutingTag } = entities;

    promises.push(
        genericForeignKeyResolver({
            data,
            fkFld: 'ratingPlanGroup',
            entity: RatingPlanGroup,
            addLink: false,
            cancelToken,
        })
    );

    promises.push(
        genericForeignKeyResolver({
            data,
            fkFld: 'routingTag',
            entity: RoutingTag,
            addLink: false,
            cancelToken,
        })
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