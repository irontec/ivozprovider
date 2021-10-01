import SettingsApplications from '@mui/icons-material/SettingsApplications';
import EntityInterface, { PropertiesList } from 'lib/entities/EntityInterface';
import _ from 'lib/services/translations/translate';
import defaultEntityBehavior from 'lib/entities/DefaultEntityBehavior';
import Form from './Form';
import entities from '../index';
import EntityService from 'lib/services/entity/EntityService';
import genericForeignKeyResolver from 'lib/services/api/genericForeigKeyResolver';

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