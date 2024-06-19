import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import GavelIcon from '@mui/icons-material/Gavel';

import { CallAclProperties } from './CallAclProperties';

const properties: CallAclProperties = {
  name: {
    label: _('Name'),
  },
  defaultPolicy: {
    label: _('Default policy'),
    enum: {
      allow: _('Allow'),
      deny: _('Deny'),
    },
  },
  //@TODO POSPONED CallAclRelMatchLists subscreen list
};

const CallAcl: EntityInterface = {
  ...defaultEntityBehavior,
  icon: GavelIcon,
  link: '/doc/en/administration_portal/client/vpbx/user_configuration/call_acls.html',
  iden: 'CallAcl',
  title: _('Call ACL', { count: 2 }),
  path: '/call_acls',
  properties,
  defaultOrderBy: '',
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'CallACL',
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

export default CallAcl;
