import QuickreplyIcon from '@mui/icons-material/Quickreply';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import Form from './Form';
import { foreignKeyGetter } from './foreignKeyGetter'
import { PartialPropertyList } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import foreignKeyResolver from './foreignKeyResolver';
import selectOptions from './SelectOptions';

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
    foreignKeyResolver,
    selectOptions: (props, customProps) => { return selectOptions(props, customProps); },
};

export default outgoingDdiRule;