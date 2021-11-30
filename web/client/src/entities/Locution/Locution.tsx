import SettingsApplications from '@mui/icons-material/SettingsApplications';
import EntityInterface from 'lib/entities/EntityInterface';
import _ from 'lib/services/translations/translate';
import defaultEntityBehavior from 'lib/entities/DefaultEntityBehavior';
import Form, { foreignKeyGetter } from './Form';
import { LocutionProperties } from './LocutionProperties';

const properties: LocutionProperties = {
    'name': {
        label: _('Name'),
    },
    'originalFile': {
        label: _('Uploaded file'),
        type: 'file'
    },
    'status': {
        label: _('Status'),
        readOnly: true,
        enum: {
            'pending': _('pending'),
            'encoding': _('encoding'),
            'ready': _('ready'),
            'error': _('error'),
        }
    }
};

const columns = [
    'name',
    'originalFile',
    'status',
];

const locution: EntityInterface = {
    ...defaultEntityBehavior,
    icon: <SettingsApplications />,
    iden: 'Locution',
    title: _('Locution', { count: 2 }),
    path: '/locutions',
    properties,
    Form,
    foreignKeyGetter,
    columns
};

export default locution;