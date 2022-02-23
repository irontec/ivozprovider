import LockIcon from '@mui/icons-material/Lock';
import EntityInterface from 'lib/entities/EntityInterface';
import _ from 'lib/services/translations/translate';
import defaultEntityBehavior from 'lib/entities/DefaultEntityBehavior';
import Form from './Form';
import { RouteLockProperties } from './RouteLockProperties';
import selectOptions from './SelectOptions';

const properties: RouteLockProperties = {
    'name': {
        label: _('Name'),
    },
    'description': {
        label: _('Description'),
        required: false,
    },
    'open': {
        label: _('Status'),
        enum: {
            '0': _("Closed"),
            '1': _("Opened"),
        },
        default: 0
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
    icon: LockIcon,
    iden: 'RouteLock',
    title: _('Route Lock', { count: 2 }),
    path: '/route_locks',
    properties,
    columns,
    Form,
    selectOptions: (props, customProps) => { return selectOptions(props, customProps); },
};

export default routeLock;