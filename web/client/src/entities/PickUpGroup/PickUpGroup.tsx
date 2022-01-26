import SettingsApplications from '@mui/icons-material/SettingsApplications';
import EntityInterface from 'lib/entities/EntityInterface';
import _ from 'lib/services/translations/translate';
import defaultEntityBehavior from 'lib/entities/DefaultEntityBehavior';
import Form from './Form';
import { foreignKeyGetter } from './useFkChoices';
import entities from '../index';
import genericForeignKeyResolver from 'lib/services/api/genericForeigKeyResolver';
import { PickUpGroupProperties, PickUpGroupPropertiesList } from './PickUpGroupProperties';

const properties: PickUpGroupProperties = {
    'name': {
        label: _('Name'),
        required: true,
    },
    'userIds': {
        label: _('User'),
    }
};

async function foreignKeyResolver(data: PickUpGroupPropertiesList): Promise<PickUpGroupPropertiesList> {

    const promises = [];
    const { User } = entities;

    promises.push(
        genericForeignKeyResolver({
            data,
            fkFld: 'userIds',
            entity: User,
        })
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
    foreignKeyGetter,
    foreignKeyResolver
};

export default pickUpGroup;