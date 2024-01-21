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
    helpText: _(`'https://' URLs valid only (without trailing '/')`),
  },
  color: {
    label: _('Color'),
    format: 'color',
    default: '#000000',
  },
  name: {
    label: _('Name'),
    helpText: _(`Will be shown on page footer`),
  },
  logo: {
    label: _('Logo'),
    type: 'file',
  },
};

const WebPortal: EntityInterface = {
  ...defaultEntityBehavior,
  icon: InsertLinkIcon,
  link: '/doc/en/administration_portal/platform/portals.html',
  iden: 'WebPortal',
  title: _('Platform Portal', { count: 2 }),
  path: '/web_portals',
  toStr: (row: WebPortalPropertyList<EntityValue>) => row.name as string,
  properties,
  columns: ['name', 'url', 'logo'],
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'WebPortals',
  },
  selectOptions: async () => {
    const module = await import('./SelectOptions');

    return module.default;
  },
  Form: async () => {
    const module = await import('./Form');

    return module.default;
  },
};

export default WebPortal;
