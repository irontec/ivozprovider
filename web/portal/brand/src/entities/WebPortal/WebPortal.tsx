import { EntityValue } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import InsertLinkIcon from '@mui/icons-material/InsertLink';

import {
  WebPortalProperties,
  WebPortalPropertyList,
} from './WebPortalProperties';

const properties: WebPortalProperties = {
  url: {
    label: _('URL'),
    pattern: new RegExp(`^https://[^/]*$`),
    maxLength: 255,
    helpText: _(`'https://' URLs valid only (without trailing '/')`),
  },
  klearTheme: {
    label: _('Theme'),
    default: '__null__',
    null: _('Default'),
    enum: {
      irontecRed: 'Irontec-red',
      irontecBlue: 'Irontec-blue',
      absolution: 'Absolution',
      absolutionGreen: 'Absolution-green',
      absolutionRed: 'Absolution-red',
      aristo: 'Aristo',
      aristoDark: 'Aristo-dark',
      aristoGreen: 'Aristo-green',
      aristoRed: 'Aristo-red',
      delta: 'Delta',
      redmondRed: 'Redmond-red',
      twitter: 'Twitter',
      tedra: 'Tedra',
      pinkpat: 'Pinkpat',
      redinn: 'Redinn',
      grayidec: 'Grayidec',
      base: 'Base',
      blackTie: 'Black-tie',
      blitzer: 'Blitzer',
      cupertino: 'Cupertino',
      darkHive: 'Dark-hive',
      dotLuv: ' Dot-luv',
      eggplant: 'Eggplant',
      exciteBike: 'Excite-bike',
      flick: 'Flick',
      hotSneaks: 'Hot-sneaks',
      humanity: 'Humanity',
      leFrog: 'Le-frog',
      mintChoc: 'Mint-choc',
      overcast: 'Overcast',
      pepperGrinder: 'Pepper-grinder',
      redmond: 'Redmond',
      smoothness: 'Smoothness',
      southStreet: 'South-street',
      start: 'Start',
      sunny: 'Sunny',
      swankyPurse: 'Swanky-purse',
      trontastic: 'Trontastic',
      uiDarkness: 'Ui-darkness',
      uiLightness: 'Ui-lightness',
      vader: 'Vader',
    },
  },
  urlType: {
    label: _('URL Type'),
    enum: {
      admin: _('Client'),
      user: _('User', { count: 1 }),
    },
    visualToggle: {
      god: {
        show: ['klearTheme'],
        hide: ['userTheme'],
      },
      brand: {
        show: ['klearTheme'],
        hide: ['userTheme'],
      },
    },
  },
  name: {
    label: _('Name'),
    maxLength: 200,
    helpText: _(`Will be shown on page footer`),
  },
  userTheme: {
    label: _('User Theme'),
  },
  logo: {
    label: _('Logo'),
    type: 'file',
  },
  newUI: {
    label: _('New Interface'),
    helpText: _(
      `You can always access classic interface adding /classic to URL`
    ),
  },
};

const WebPortal: EntityInterface = {
  ...defaultEntityBehavior,
  icon: InsertLinkIcon,
  link: '/doc/en/administration_portal/brand/settings/client_portals.html',
  iden: 'WebPortal',
  title: _('Administration Portal', { count: 2 }),
  path: '/web_portals',
  toStr: (row: WebPortalPropertyList<EntityValue>) => `${row.id}`,
  properties,
  columns: ['name', 'urlType', 'url', 'logo'],
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'WebPortals',
  },
  selectOptions: async () => {
    const module = await import('./SelectOptions');

    return module.default;
  },
  foreignKeyResolver: async () => {
    const module = await import('./ForeignKeyResolver');

    return module.default;
  },
  foreignKeyGetter: async () => {
    const module = await import('./ForeignKeyGetter');

    return module.foreignKeyGetter;
  },
  Form: async () => {
    const module = await import('./Form');

    return module.default;
  },
};

export default WebPortal;
