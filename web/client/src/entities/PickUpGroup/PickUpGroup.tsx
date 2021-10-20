import SettingsApplications from '@mui/icons-material/SettingsApplications';
import EntityInterface from 'lib/entities/EntityInterface';
import _ from 'lib/services/translations/translate';
import defaultEntityBehavior from 'lib/entities/DefaultEntityBehavior';
import Form from './Form';
import entities from '../index';
import EntityService, { EntityValues } from 'lib/services/entity/EntityService';
import genericForeignKeyResolver from 'lib/services/api/genericForeigKeyResolver';
import { PickUpGroupProperties, PickUpGroupPropertiesList } from './PickUpGroupProperties';

const properties: PickUpGroupProperties = {
    'name': {
        label: _('Name'),
    },
    'userIds': {
        label: _('User'),
    }
};

async function foreignKeyResolver(data: PickUpGroupPropertiesList, entityService: EntityService) {

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