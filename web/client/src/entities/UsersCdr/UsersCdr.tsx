import ChatBubbleOutlineIcon from '@mui/icons-material/ChatBubbleOutline';
import EntityInterface, { OrderDirection } from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import View from './View';
import { UsersCdrProperties } from './UsersCdrProperties';
import foreignKeyResolver from './foreignKeyResolver';

const properties: UsersCdrProperties = {
    'startTime': {
        label: _('Start time'),
        readOnly: true,
    },
    'owner': {
        label: _('Owner'),
        readOnly: true,
    },
    'duration': {
        label: _('Duration'),
        readOnly: true,
    },
    'direction': {
        label: _('Direction'),
        enum: {
            'inbound': _("Inbound"),
            'outbound': _("Outbound"),
        },
        readOnly: true,
    },
    'caller': {
        label: _('Source'),
        readOnly: true,
    },
    'callee': {
        label: _('Destination'),
        readOnly: true,
    },
    'callid': {
        label: _('Callid'),
        readOnly: true,
    },
    'xcallid': {
        label: _('Xcallid'),
        readOnly: true,
    },
    'callidHash': {
        label: _('CallidHash'),
        readOnly: true,
    },
    'party': {
        label: _('Party'),
        readOnly: true,
    },
};

const columns = [
    'startTime',
    'owner',
    'direction',
    'party',
    'duration',
];

const usersCdr: EntityInterface = {
    ...defaultEntityBehavior,
    icon: ChatBubbleOutlineIcon,
    iden: 'UsersCdr',
    title: _('Call registry', { count: 2 }),
    path: '/users_cdrs',
    properties,
    columns,
    foreignKeyResolver,
    View,
    defaultOrderBy: 'startTime',
    defaultOrderDirection: OrderDirection.desc,
};

export default usersCdr;