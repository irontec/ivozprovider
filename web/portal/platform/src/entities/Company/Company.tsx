import AccountTreeIcon from '@mui/icons-material/AccountTree';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { EntityValue } from '@irontec/ivoz-ui';
import { CompanyProperties, CompanyPropertyList } from './CompanyProperties';

const properties: CompanyProperties = {};

const Company: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AccountTreeIcon,
  iden: 'Company',
  title: _('Client', { count: 2 }),
  path: '/companies',
  toStr: (row: CompanyPropertyList<EntityValue>) => row.name as string,
  properties,
};

export default Company;
