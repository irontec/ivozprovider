import FormatListBulletedIcon from '@mui/icons-material/FormatListBulleted';
import EntityInterface, { OrderDirection } from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { VoicemailMessageProperties } from './VoicemailMessageProperties';
import View from './View';
import Status from "../VoicemailMessage/Field/Status";

const properties: VoicemailMessageProperties = {
    'status': {
        label: _('Status'),
        component: Status,
    },
    'folder': {
        label: _('Folder'),
    },
    'calldate': {
        label: _('Date'),
    },
    'caller': {
        label: _('Caller'),
    },
    'duration': {
        label: _('Duration'),
    },
    'recordingFile': {
        label: _('Recording'),
        type: 'file'
    },
};

const columns = [
    'status',
    'calldate',
    'caller',
    'duration',
];

const voicemailMessage: EntityInterface = {
    ...defaultEntityBehavior,
    icon: FormatListBulletedIcon,
    iden: 'VoicemailMessage',
    title: _('VoicemailMessage', { count: 2 }),
    path: '/voicemail_messages',
    properties,
    columns,
    acl: {
        ...defaultEntityBehavior.acl,
        iden: 'VoicemailMessages',
    },
    View,
    defaultOrderBy: 'calldate',
    defaultOrderDirection: OrderDirection.desc,
};

export default voicemailMessage;