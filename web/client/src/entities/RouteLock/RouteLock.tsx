import SettingsApplications from '@mui/icons-material/SettingsApplications';
import EntityInterface, { PropertiesList } from 'entities/EntityInterface';
import _ from 'services/Translations/translate';
import defaultEntityBehavior from 'entities/DefaultEntityBehavior';
import Form from './Form';

const properties: PropertiesList = {
    'name': {
        label: _('Name'),
    },
    'description': {
        label: _('Description'),
    },
    'open': {
        label: _('Status'),
        enum: {
            '0': _("Closed"),
            '1': _("Opened"),
        }
    },
    'closeExtension': {
        label: _('Close extension'),
    },
    'openExtension': {
        label: _('Open extension'),
    },
    'toggleExtension': {
        label: _('Toggle extension'),
    },
};

const columns = [
    'name',
    'description',
    'open',
    'closeExtension',
    'openExtension',
    'toggleExtension',
];

const routeLock: EntityInterface = {
    ...defaultEntityBehavior,
    icon: <SettingsApplications />,
    iden: 'RouteLock',
    title: _('Route Lock', { count: 2 }),
    path: '/route_locks',
    properties,
    columns,
    Form
};

export default routeLock;