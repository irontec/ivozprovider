import FaxIcon from '@mui/icons-material/Fax';
import EntityInterface from 'lib/entities/EntityInterface';
import _ from 'lib/services/translations/translate';
import defaultEntityBehavior from 'lib/entities/DefaultEntityBehavior';
import Form from './Form';
import { foreignKeyGetter } from './foreignKeyGetter';
import { FaxProperties } from './FaxProperties';
import foreignKeyResolver from './foreignKeyResolver';
import selectOptions from './SelectOptions';

const properties: FaxProperties = {
    'name': {
        label: _('Name'),
    },
    'email': {
        label: _('Email'),
    },
    'sendByEmail': {
        label: _('Send by email'),
        enum: {
            '0': _('No'),
            '1': _('Yes'),
        },
        default: '1',
        visualToggle: {
            '0': {
                show: [],
                hide: ['email'],
            },
            '1': {
                show: ['email'],
                hide: [],
            },
        }
    },
    'outgoingDdi': {
        label: _('Outgoing DDI'),
        null: _("Client's default")
    },
};

const columns = [
    'name',
    'outgoingDdi',
    'sendByEmail',
    'email',
];

const fax: EntityInterface = {
    ...defaultEntityBehavior,
    icon: FaxIcon,
    iden: 'Fax',
    title: _('Fax', { count: 2 }),
    path: '/faxes',
    toStr: (row: any) => row.name,
    properties,
    columns,
    Form,
    foreignKeyGetter,
    foreignKeyResolver,
    selectOptions,
    initialValues: {
        outgoingDdi: null,
    }
};

export default fax;