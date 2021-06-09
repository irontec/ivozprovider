import SettingsApplications from '@material-ui/icons/SettingsApplications';
import EntityInterface from 'entities/EntityInterface';
import _ from 'services/Translations/translate';
import defaultEntityBehavior from 'entities/DefaultEntityBehavior';
import Form from 'entities/Terminal/Form'

const columns = {
    'id': _('Id'),
    'name': _('Name'),
    'mac': _('MAC'),
    'lastProvisionDate': _('Last provision date'),
    'disallow': _('Disallowed audio codecs'),
    'allowAudio': _('Allowed audio codecs'),
    'allowVideo': _('Allowed video codecs'),
    'directMediaMethod': _('CallerID update method'),
    'password': _('Password'),
    't38Passthrough': _('Enable T.38 passthrough'),
    'rtpEncryption': _('RTP encryption'),
    'terminalModel': _('Terminal model'),
};

const properties = {
    name: {
        helpText: _("Allowed characters: a-z, A-Z, 0-9, underscore and '*'"),
    },
    password: {
        helpText: _("Minimal length 10, including 3 uppercase letters, 3 lowercase letters, 3 digits and one character in '+*_-'")
    },
    allowAudio: {
        enum: {
            'alaw': 'alaw - G.711 a-law',
            'ulaw': 'ulaw - G.711 u-law',
            'gsm': 'gsm - GSM',
            'speex': 'speex - SpeeX 32khz',
            'g722': 'g722 - G.722',
            'g726': 'g726 - G.726 RFC3551',
            'g729': 'g729 - G.729A',
            'ilbc': 'ilbc - iLBC',
            'opus': 'opus - Opus codec',
        }
    },
    t38Passthrough: {
        enum: {
            'yes': _('Yes'),
            'no': _('No'),
        }
    },
    allowVideo: {
        values: {
            'h264': 'h264 - H.264',
            '__null__': _("Disabled"),
        }
    },
    rtpEncryption: {
        values: {
            '0': _('No'),
            '1': _('Yes'),
        },
        helpText: _("Enable to force audio encryption. Call won't be established unless it is encrypted.")
    }
};

const terminal:EntityInterface = {
    ...defaultEntityBehavior,
    icon: <SettingsApplications />,
    iden: 'Terminal',
    title: _('Terminal', {count: 1}),
    path: '/terminals',
    columns,
    properties,
    Form
};

export default terminal;