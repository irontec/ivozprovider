import AccountTreeIcon from '@mui/icons-material/AccountTree';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { ExtensionProperties } from './ExtensionProperties';

const properties: ExtensionProperties = {
  number: {
    label: _('Number'),
  },
};

const Extension: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AccountTreeIcon,
  iden: 'Extension',
  title: _('Extension', { count: 2 }),
  path: '/extensions',
  toStr: (row: any) => row.number,
  properties,
};

export default Extension;
