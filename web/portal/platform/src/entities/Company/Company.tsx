import { EntityValue } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import AccountTreeIcon from '@mui/icons-material/AccountTree';

import { CompanyProperties, CompanyPropertyList } from './CompanyProperties';

const properties: CompanyProperties = {};

const Company: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AccountTreeIcon,
  link: '/doc/en/administration_portal/brand/clients/virtual_pbx.html',
  iden: 'Company',
  title: _('Client', { count: 2 }),
  path: '/companies',
  toStr: (row: CompanyPropertyList<EntityValue>) => row.name as string,
  properties,
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'Companies',
  },
  selectOptions: async () => {
    const module = await import('./SelectOptions');

    return module.default;
  },
};

export default Company;
