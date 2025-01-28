import { EntityValue } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import InsertLinkIcon from '@mui/icons-material/InsertLink';

import { WebPortalPropertyList } from './WebPortalProperties';

const WebPortal: EntityInterface = {
  ...defaultEntityBehavior,
  icon: InsertLinkIcon,
  link: '/doc/en/administration_portal/brand/settings/client_portals.html',
  iden: 'WebPortal',
  title: _('Administration Portal', { count: 2 }),
  path: '/web_portals',
  toStr: (row: WebPortalPropertyList<EntityValue>) => `${row.id}`,
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'WebPortals',
  },
  defaultOrderBy: '',
};

export default WebPortal;
