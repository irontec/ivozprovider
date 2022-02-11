import PhoneCallbackIcon from '@mui/icons-material/PhoneCallback';
import EntityInterface from 'lib/entities/EntityInterface';
import _ from 'lib/services/translations/translate';
import defaultEntityBehavior from 'lib/entities/DefaultEntityBehavior';
import Form from './Form';
import { foreignKeyGetter } from './foreignKeyGetter';
import { PickUpGroupProperties } from './PickUpGroupProperties';
import foreignKeyResolver from './foreignKeyResolver';

const properties: PickUpGroupProperties = {
    'name': {
        label: _('Name'),
        required: true,
    },
    'userIds': {
        label: _('User'),
    }
};

const pickUpGroup: EntityInterface = {
    ...defaultEntityBehavior,
    icon: PhoneCallbackIcon,
    iden: 'PickUpGroup',
    title: _('Pick up group', { count: 2 }),
    path: '/pick_up_groups',
    properties,
    Form,
    foreignKeyGetter,
    foreignKeyResolver
};

export default pickUpGroup;