import { EntityValues } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import AccountTreeIcon from '@mui/icons-material/AccountTree';

import {
  ExtensionProperties,
  ExtensionPropertyList,
} from './ExtensionProperties';

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
  toStr: (row: ExtensionPropertyList<EntityValues>) => `${row.number}`,
  properties,
};

export default Extension;
