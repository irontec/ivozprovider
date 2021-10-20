import SettingsApplications from '@mui/icons-material/SettingsApplications';
import EntityInterface from 'lib/entities/EntityInterface';
import EntityService from 'lib/services/entity/EntityService';
import defaultEntityBehavior from 'lib/entities/DefaultEntityBehavior';
import genericForeignKeyResolver from 'lib/services/api/genericForeigKeyResolver';
import _ from 'lib/services/translations/translate';
import Form from './Form'
import entities from '../index';
import { TerminalProperties, TerminalPropertiesList } from './TerminalProperties';

const properties: TerminalProperties = {
    'name': {
        label: _('Name'),
        helpText: _("Allowed characters: a-z, A-Z, 0-9, underscore and '*'"),
    },
    'mac': {
        label: _('MAC'),
    },
    'lastProvisionDate': {
        label: _('Last provision date'),
    },
    'disallow': {
        label: _('Disallowed audio codecs'),
    },
    'allowAudio': {
        label: _('Allowed audio codecs'),
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
    'allowVideo': {
        label: _('Allowed video codecs'),
        enum: {
            'h264': 'h264 - H.264',
        },
        null: _("Disabled"),
    },
    'directMediaMethod': {
        label: _('CallerID update method'),
    },
    'password': {
        label: _('Password'),
        helpText: _("Minimal length 10, including 3 uppercase letters, 3 lowercase letters, 3 digits and one character in '+*_-'")
    },
    't38Passthrough': {
        label: _('Enable T.38 passthrough'),
        enum: {
            'yes': _('Yes'),
            'no': _('No'),
        }
    },
    'rtpEncryption': {
        label: _('RTP encryption'),
        enum: {
            '0': _('No'),
            '1': _('Yes'),
        },
        helpText: _("Enable to force audio encryption. Call won't be established unless it is encrypted.")
    },
    'terminalModel': {
        label: _('Terminal model'),
    },
    'domain': {
        label: _('Domain'),
    },
};

async function foreignKeyResolver(data: TerminalPropertiesList, entityService: EntityService) {

    const promises = [];
    const { TerminalModel } = entities;

    promises.push(
        genericForeignKeyResolver(
            data,
            'terminalModel',
            TerminalModel.path,
            TerminalModel.toStr,
            TerminalModel.acl.update
        )
    );

    await Promise.all(promises);

    return data;
}

const terminal: EntityInterface = {
    ...defaultEntityBehavior,
    icon: <SettingsApplications />,
    iden: 'Terminal',
    title: _('Terminal', { count: 2 }),
    path: '/terminals',
    toStr: (row: any) => row.name,
    properties,
    Form,
    foreignKeyResolver
};

export default terminal;