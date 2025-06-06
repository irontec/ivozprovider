import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import FaxIcon from '@mui/icons-material/Fax';

import Status from '../RetailAccount/Field/Status';
import StatusIcon from '../RetailAccount/Field/StatusIcon';
import Password from './Field/Password';
import { TerminalProperties, TerminalPropertyList } from './TerminalProperties';

const properties: TerminalProperties = {
  name: {
    label: _('Name'),
    helpText: _("Allowed characters: a-z, A-Z, 0-9, underscore and '*'"),
    required: true,
  },
  mac: {
    label: _('MAC'),
  },
  lastProvisionDate: {
    label: _('Last provision date'),
  },
  disallow: {
    label: _('Disallowed audio codecs'),
    default: 'all',
  },
  allowAudio: {
    label: _('Allowed audio codecs'),
    enum: {
      alaw: 'alaw - G.711 a-law',
      ulaw: 'ulaw - G.711 u-law',
      gsm: 'gsm - GSM',
      speex: 'speex - SpeeX 32khz',
      g722: 'g722 - G.722',
      g726: 'g726 - G.726 RFC3551',
      g729: 'g729 - G.729A',
      ilbc: 'ilbc - iLBC',
      opus: 'opus - Opus codec',
    },
    default: 'alaw',
  },
  allowVideo: {
    label: _('Allowed video codecs'),
    enum: {
      h264: 'h264 - H.264',
    },
    null: _('Disabled'),
  },
  directMediaMethod: {
    label: _('CallerID update method'),
    enum: {
      invite: 'invite',
      update: 'update',
    },
    default: 'invite',
  },
  password: {
    label: _('Password'),
    helpText: _(
      "Minimal length 10, including 3 uppercase letters, 3 lowercase letters, 3 digits and one character in '+*_-'"
    ),
    component: Password,
  },
  t38Passthrough: {
    label: _('Enable T.38 passthrough'),
    enum: {
      yes: _('Yes'),
      no: _('No'),
    },
    default: 'no',
  },
  rtpEncryption: {
    label: _('RTP encryption'),
    enum: {
      '0': _('No'),
      '1': _('Yes'),
    },
    default: '0',
    helpText: _(
      "Enable to force audio encryption. Call won't be established unless it is encrypted."
    ),
  },
  terminalModel: {
    label: _('Terminal model', { count: 1 }),
  },
  domain: {
    label: _('SIP Domain', { count: 1 }),
    $ref: '#/definitions/Domain',
  },
  statusIcon: {
    label: _('Status'),
    component: StatusIcon,
  },
  status: {
    label: _('Status'),
    component: Status,
  },
};

const terminal: EntityInterface = {
  ...defaultEntityBehavior,
  icon: FaxIcon,
  link: '/doc/${language}/administration_portal/client/vpbx/terminals.html',
  iden: 'Terminal',
  title: _('Terminal', { count: 2 }),
  path: '/terminals',
  toStr: (row: TerminalPropertyList<string>) => `${row.name}`,
  properties,
  defaultOrderBy: '',
  columns: ['name', 'domain', 'terminalModel', 'mac', 'statusIcon'],
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'Terminals',
  },
  selectOptions: async () => {
    const module = await import('./SelectOptions');

    return module.default;
  },
  foreignKeyResolver: async () => {
    const module = await import('./ForeignKeyResolver');

    return module.default;
  },
  Form: async () => {
    const module = await import('./Form');

    return module.default;
  },
};

export default terminal;
