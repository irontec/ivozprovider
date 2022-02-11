import QuickreplyIcon from '@mui/icons-material/Quickreply';
import EntityInterface from 'lib/entities/EntityInterface';
import _ from 'lib/services/translations/translate';
import defaultEntityBehavior from 'lib/entities/DefaultEntityBehavior';
import Form from './Form';
import { foreignKeyGetter } from './foreignKeyGetter'
import { PartialPropertyList } from 'lib/services/api/ParsedApiSpecInterface';
import foreignKeyResolver from './foreignKeyResolver';

const properties: PartialPropertyList = {
    'name': {
        label: _('Name'),
    },
    'defaultAction': {
        label: _('Default Action'),
        enum: {
            'keep': _("Keep Original DDI"),
            'force': _("Force DDI"),
        },
        visualToggle: {
            'keep': {
                show: [],
                hide: ['forcedDdi'],
            },
            'force': {
                show: ['forcedDdi'],
                hide: [],
            },
        }
    },
    'forcedDdi': {
        label: _('Forced DDI'),
        null: _("Client's default"),
        default: '__null__',
    }
};

const columns = [
    'name',
    'defaultAction',
    'forcedDdi',
];

const outgoingDdiRule: EntityInterface = {
    ...defaultEntityBehavior,
    icon: QuickreplyIcon,
    iden: 'OutgoingDdiRule',
    title: _('Outgoing DDI Rule', { count: 2 }),
    path: '/outgoing_ddi_rules',
    properties,
    columns,
    Form,
    foreignKeyGetter,
    foreignKeyResolver
};

export default outgoingDdiRule;