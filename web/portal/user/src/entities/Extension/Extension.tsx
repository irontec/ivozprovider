import { EntityValue } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import AccountTreeIcon from '@mui/icons-material/AccountTree';

import { ExtensionPropertyList } from './ExtensionProperties';

const extension: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AccountTreeIcon,
  iden: 'Extension',
  title: _('Extension', { count: 2 }),
  path: '/my/company_extensions',
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'Extension',
  },
  selectOptions: async () => {
    const module = await import('./SelectOptions');

    return module.default;
  },
  toStr: (row: ExtensionPropertyList<EntityValue>) => row.number as string,
};

export default extension;
