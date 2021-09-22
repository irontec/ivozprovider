import SettingsApplications from '@mui/icons-material/SettingsApplications';
import EntityInterface, { PropertiesList } from 'entities/EntityInterface';
import _ from 'services/Translations/translate';
import defaultEntityBehavior from 'entities/DefaultEntityBehavior';
import Form from './Form';
import entities from '../index';
import EntityService from 'services/Entity/EntityService';
import genericForeignKeyResolver from 'services/genericForeigKeyResolver';

const properties: PropertiesList = {
    'name': {
        label: _('Name'),
    },
    userIds: {
        label: _('User'),
    }
};

async function foreignKeyResolver(data: any, entityService: EntityService) {

    const promises = [];
    const { User } = entities;

    promises.push(
        genericForeignKeyResolver(
            data,
            'userIds',
            User.path,
            User.toStr,
        )
    );

    await Promise.all(promises);

    return data;
}

const pickUpGroup: EntityInterface = {
    ...defaultEntityBehavior,
    icon: <SettingsApplications />,
    iden: 'PickUpGroup',
    title: _('Pick up group', { count: 2 }),
    path: '/pick_up_groups',
    properties,
    Form,
    foreignKeyResolver
};

export default pickUpGroup;