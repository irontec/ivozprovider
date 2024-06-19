import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import AccountTreeIcon from '@mui/icons-material/AccountTree';

import { CallAclRelMatchListProperties } from './CallAclRelMatchListProperties';

const properties: CallAclRelMatchListProperties = {
  priority: {
    label: _('Priority'),
  },
  policy: {
    label: _('Policy'),
    enum: {
      allow: _('Allow'),
      deny: _('Deny'),
    },
  },
  callAcl: {
    label: _('Call ACL', { count: 1 }),
  },
  matchList: {
    label: _('Match List', { count: 1 }),
  },
};

const CallAclRelMatchList: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AccountTreeIcon,
  iden: 'CallAclRelMatchList',
  title: _('Call ACL MatchList', { count: 2 }),
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'CallAclRelMatchList',
  },
  path: '/call_acl_rel_match_lists',
  properties,
  Form: async () => {
    const module = await import('./Form');

    return module.default;
  },
};

export default CallAclRelMatchList;
