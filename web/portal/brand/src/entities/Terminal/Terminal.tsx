import { EntityValues } from '@irontec-voip/ivoz-ui';
import defaultEntityBehavior from '@irontec-voip/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec-voip/ivoz-ui/entities/EntityInterface';
import _ from '@irontec-voip/ivoz-ui/services/translations/translate';
import AccountTreeIcon from '@mui/icons-material/AccountTree';

import { TerminalProperties, TerminalPropertyList } from './TerminalProperties';

const properties: TerminalProperties = {
  name: {
    label: _('Name'),
  },
};

const Terminal: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AccountTreeIcon,
  iden: 'Terminal',
  title: _('Terminal', { count: 2 }),
  path: '/terminals',
  toStr: (row: TerminalPropertyList<EntityValues>) => `${row.name}`,
  properties,
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'Terminals',
  },
};

export default Terminal;
