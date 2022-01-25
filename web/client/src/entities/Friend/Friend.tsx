import SettingsApplications from '@mui/icons-material/SettingsApplications';
import EntityInterface from 'lib/entities/EntityInterface';
import _ from 'lib/services/translations/translate';
import defaultEntityBehavior from 'lib/entities/DefaultEntityBehavior';
import StatusIcon from './Field/StatusIcon';
import Form from './Form';
import { foreignKeyGetter } from './useFkChoices';
import { FriendProperties } from './FriendProperties';
import Password from 'entities/Terminal/Field/Password';

const properties: FriendProperties = {
    'name': {
        label: _('Name'),
        helpText: _("Allowed characters: a-z, A-Z, 0-9, underscore and '*'"),
        required: true,
    },
    'domain': {
        label: _('Domain'),
    },
    'description': {
        label: _('Description'),
    },
    'transport': {
        label: _('Transport'),
        enum: {
            'udp': _('UDP'),
            'tcp': _('TCP'),
            'tls': _('TLS'),
        }
    },
    'ip': {
        label: _('Destination IP address'),
        helpText: _('e.g. 8.8.8.8'),
        required: true,
    },
    'port': {
        label: _('Port'),
        pattern: new RegExp('^[0-9]+$'),
        default: 5060,
        required: true,
    },
    'password': {
        label: _('Password'),
        helpText: _("Minimal length 10, including 3 uppercase letters, 3 lowercase letters, 3 digits and one character in '+*_-'"),
        component: Password,
    },
    'callAcl': {
        label: _('Call ACL'),
        null: _("Allow all outgoing calls"),
    },
    'transformationRuleSet': {
        label: _('Numeric transformation'),
        null: _("Client's default"),
        default: '__null__',
    },
    'outgoingDdi': {
        label: _('Fallback Outgoing DDI'),
        helpText: _("This DDI will be used if presented DDI doesn't match any of the company DDIs"),
        null: _("Client's default"),
    },
    'priority': {
        label: _('Priority'),
        default: 1,
    },
    'disallow': {
        label: _('Disallowed audio codecs'),
        default: 'all',
    },
    'allow': {
        label: _('Allowed audio codecs'),
        enum: {
            'alaw': _('alaw - G.711 a-law'),
            'ulaw': _('ulaw - G.711 u-law'),
            'gsm': _('gsm - GSM'),
            'speex': _('speex - SpeeX 32khz'),
            'g722': _('g722 - G.722'),
            'g726': _('g726 - G.726 RFC3551'),
            'g729': _('g729 - G.729A'),
            'ilbc': _('ilbc - iLBC'),
            'opus': _('opus - Opus codec'),
        },
        default: 'alaw',
    },
    'directMediaMethod': {
        label: _('CallerID update method'),
        enum: {
            'invite': _('invite'),
            'update': _('update'),
        },
        default: 'update',
    },
    'calleridUpdateHeader': {
        label: _('CallerID update header'),
        enum: {
            'pai': _('P-Asserted-Identity (PAI)'),
            'rpid': _('Remote-Party-ID (RPID)'),
        },
        default: 'pai',
    },
    'updateCallerid': {
        label: _('Update CallerID?'),
        enum: {
            'yes': _('Yes'),
            'no': _('No'),
        },
        default: 'yes',
        visualToggle: {
            'yes': {
                show: ['direct_media_method', 'callerid_update_header'],
                hide: [],
            },
            'no': {
                show: [],
                hide: ['direct_media_method', 'callerid_update_header'],
            },
        }
    },
    'fromDomain': {
        label: _('From domain'),
    },
    'fromUser': {
        label: _('From user'),
    },
    'directConnectivity': {
        label: _('Connectivity mode'),
        enum: {
            'yes': _('Direct'),
            'no': _('Register'),
            'intervpbx': _('Inter vPBX'),
        },
        default: 'no',
        visualToggle: {
            'yes': {
                show: [
                    'name',
                    'domain',
                    'password',
                    'ip',
                    'port',
                    'transport',
                    'ddiIn',
                    'allow',
                    'fromUser',
                    'fromDomain',
                    'language',
                    'transformationRuleSet',
                    'callACL',
                    'rtpEncryption',
                ],
                hide: [
                    'multiContact',
                ],
            },
            'no': {
                show: [
                    'name',
                    'password',
                    'ddiIn',
                    'allow',
                    'fromUser',
                    'fromDomain',
                    'language',
                    'transformationRuleSet',
                    'callACL',
                    'rtpEncryption',
                    'multiContact',
                ],
                hide: [
                    'ip',
                    'port',
                    'transport',
                ],
            },
            'intervpbx': {
                show: [],
                hide: [
                    'name',
                    'ip',
                    'port',
                    'transport',
                    'password',
                    'ddiIn',
                    'allow',
                    'fromUser',
                    'fromDomain',
                    'language',
                    'transformationRuleSet',
                    'callACL',
                    't38Passthrough',
                    'rtpEncryption',
                    'multiContact',
                    'outgoingDdi',
                    'alwaysApplyTransformations',
                ],
            },
        }
    },
    'ddiIn': {
        label: _('DDI In'),
        enum: {
            'yes': _('Yes'),
            'no': _('No'),
        },
        default: 'yes',
        helpText: _("If set to 'Yes', set destination (R-URI and To) to called DDI/number when calling to this friend.")
    },
    'language': {
        label: _('Language'),
        default: '__null__',
        null: _("Client's default"),
    },
    't38Passthrough': {
        label: _('Enable T.38 passthrough'),
        enum: {
            'yes': _('Yes'),
            'no': _('No'),
        },
        default: 'no',
    },
    'alwaysApplyTransformations': {
        label: _('Always apply transformations'),
        enum: {
            '0': _('No'),
            '1': _('Yes'),
        },
        default: '0',
        helpText: _("Enable to force numeric transformation on numbers in Extensions or numbers matching any Friend regexp. Otherwise, those numbers won't traverse numeric transformations rules.")
    },
    'rtpEncryption': {
        label: _('RTP encryption'),
        enum: {
            '0': _('No'),
            '1': _('Yes'),
        },
        default: '0',
        helpText: _("Enable to force audio encryption. Call won't be established unless it is encrypted.")
    },
    'multiContact': {
        label: _('Multi contact'),
        enum: {
            '0': _('No'),
            '1': _('Yes'),
        },
        default: '0',
        helpText: _("Set to 'No' to call only to latest registered SIP device instead of making all registered devices ring.")
    },
    'statusIcon': {
        label: _('Status'),
        component: StatusIcon
    }
};

const columns = [
    'name',
    'domain',
    'description',
    'priority',
    'statusIcon',
];

const friend: EntityInterface = {
    ...defaultEntityBehavior,
    icon: <SettingsApplications />,
    iden: 'Friend',
    title: _('Friend', { count: 2 }),
    path: '/friends',
    properties,
    columns,
    Form,
    foreignKeyGetter
};

export default friend;