import PhoneCallbackIcon from '@mui/icons-material/PhoneCallback';
import EntityInterface, { foreignKeyResolverType } from 'lib/entities/EntityInterface';
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

const foreignKeyResolver: foreignKeyResolverType = async function(
    { data, cancelToken }
): Promise<PickUpGroupPropertiesList> {

    const promises = [];
    const { User } = entities;

    promises.push(
        genericForeignKeyResolver({
            data,
            fkFld: 'userIds',
            entity: User,
            cancelToken,
        })
    );

    await Promise.all(promises);

    return data;
}

const pickUpGroup: EntityInterface = {
    ...defaultEntityBehavior,
    icon: <PhoneCallbackIcon />,
    iden: 'PickUpGroup',
    title: _('Pick up group', { count: 2 }),
    path: '/pick_up_groups',
    properties,
    Form,
    foreignKeyGetter,
    foreignKeyResolver
};

export default pickUpGroup;