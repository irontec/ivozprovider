import AccountTreeIcon from '@mui/icons-material/AccountTree';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { TerminalProperties } from './TerminalProperties';

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
  toStr: (row: any) => row.name,
  properties,
};

export default Terminal;
