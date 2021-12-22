import SettingsApplications from '@mui/icons-material/SettingsApplications';
import EntityInterface from 'lib/entities/EntityInterface';
import _ from 'lib/services/translations/translate';
import defaultEntityBehavior from 'lib/entities/DefaultEntityBehavior';
import Form, { foreignKeyGetter } from './Form'
import { QueueProperties } from './QueueProperties';

const timeoutFields = [
    'timeoutNumberCountry',
    'timeoutNumberValue',
    'timeoutExtension',
    'timeoutVoiceMailUser',
];

const fullFields = [
    'fullNumberCountry',
    'fullNumberValue',
    'fullExtension',
    'fullVoiceMailUser',
];

const properties: QueueProperties = {
    'name': {
        label: _('Name'),
        helpText: _("Allowed characters: a-z, A-Z, 0-9, underscore and '-'"),
    },
    'maxWaitTime': {
        label: _('Max wait time'),
        helpText: _('If no queue member answers before time this seconds, the timeout queue logic will be activated. Leave empty to disable.'),
    },
    'timeoutLocution': {
        label: _('Locution'),
    },
    'timeoutTargetType': {
        label: _('Timeout route'),
        enum: {
            'number': _('Number'),
            'extension': _('Extension'),
            'voicemail': _('Voicemail'),
        },
        null: _("Unassigned"),
        visualToggle: {
            '__null__': {
                show: [],
                hide: timeoutFields,
            },
            'number': {
                show: ['timeoutNumberCountry', 'timeoutNumberValue'],
                hide: timeoutFields,
            },
            'extension': {
                show: ['timeoutExtension'],
                hide: timeoutFields,
            },
            'voicemail': {
                show: ['timeoutVoiceMailUser'],
                hide: timeoutFields,
            },
        }
    },
    'timeoutNumberCountry': {
        label: _('Country'),
    },
    'timeoutNumberValue': {
        label: _('Number'),
    },
    'timeoutExtension': {
        label: _('Extension'),
    },
    'timeoutVoiceMailUser': {
        label: _('Voicemail'),
    },
    'maxlen': {
        label: _('Max queue length'),
        helpText: _('Max number of unattended calls that this queue can have. When this value has been reached, full queue logic will be activated on new calls. Leave empty to disable.'),
    },
    'fullLocution': {
        label: _('Full queue Locution'),
    },
    'fullTargetType': {
        label: _('Full queue route'),
        enum: {
            'number': _('Number'),
            'extension': _('Extension'),
            'voicemail': _('Voicemail'),
        },
        null: _("Unassigned"),
        visualToggle: {
            '__null__': {
                show: [],
                hide: fullFields,
            },
            'number': {
                show: ['fullNumberCountry', 'fullNumberValue'],
                hide: fullFields,
            },
            'extension': {
                show: ['fullExtension'],
                hide: fullFields,
            },
            'voicemail': {
                show: ['fullVoiceMailUser'],
                hide: fullFields,
            },
        }
    },
    'fullNumberCountry': {
        label: _('Country'),
    },
    'fullNumberValue': {
        label: _('Number'),
    },
    'fullExtension': {
        label: _('Extension'),
    },
    'fullVoiceMailUser': {
        label: _('Voicemail'),
    },
    'periodicAnnounceLocution': {
        label: _('Periodic Annouce Locution'),
        helpText: _("Locution periodically played to calls that are queued"),
    },
    'periodicAnnounceFrequency': {
        label: _('Periodic Announce Frequency'),
    },
    'memberCallRest': {
        label: _('Member rest seconds'),
        default: 0,
        helpText: _("Time in seconds that member won't be disturbed after attending a queue call"),
    },
    'memberCallTimeout': {
        label: _('Member call seconds'),
        default: 5,
        helpText: _('Time in seconds queue calls will ring members')
    },
    'strategy': {
        label: _('Strategy'),
        enum: {
            'ringall': _('Ring all'),
            'leastrecent': _('Least recent'),
            'fewestcalls': _('Fewest calls'),
            'random': _('Random'),
            'rrmemory': _('Round Robin memory'),
            'linear': _('Linear'),
        },
        default: 'rrmemory',
        helpText: _('Determines the order current priority members will be called'),
    },
    'weight': {
        label: _('Weight'),
        default: 5,
    },
    'preventMissedCalls': {
        label: _('Prevent missed calls'),
        enum: {
            '0': _('No'),
            '1': _('Yes'),
        },
        default: '1',
        helpText: _("When 'Yes', calls will never generate a missed call. When 'No', missed calls will be prevented only for RingAll queues if someone answers."),
    },
};

const columns = [
    'name',
    'weight',
    'strategy',
    'memberCallTimeout',
    'memberCallRest',
    'maxWaitTime',
    'maxlen',
];

const queue: EntityInterface = {
    ...defaultEntityBehavior,
    icon: <SettingsApplications />,
    iden: 'Queue',
    title: _('Queue', { count: 2 }),
    path: '/queues',
    toStr: (row: any) => row.name,
    properties,
    columns,
    Form,
    foreignKeyGetter
};

export default queue;