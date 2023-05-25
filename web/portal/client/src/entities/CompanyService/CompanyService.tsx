import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import MiscellaneousServicesIcon from '@mui/icons-material/MiscellaneousServices';

import { CompanyServiceProperties } from './CompanyServiceProperties';

const properties: CompanyServiceProperties = {
  service: {
    label: _('Service'),
  },
  code: {
    label: _('Code'),
    prefix: <span>*</span>,
    pattern: new RegExp('^[#0-9*]+$'),
    helpText: _('Allowed characters are 0-9, * and #'),
  },
};

const columns = ['service', 'code'];

const companyService: EntityInterface = {
  ...defaultEntityBehavior,
  icon: MiscellaneousServicesIcon,
  iden: 'CompanyService',
  title: _('Service', { count: 2 }),
  path: '/company_services',
  properties,
  columns,
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'CompanyServices',
  },
  foreignKeyResolver: async () => {
    const module = await import('./ForeignKeyResolver');

    return module.default;
  },
  foreignKeyGetter: async () => {
    const module = await import('./ForeignKeyGetter');

    return module.foreignKeyGetter;
  },
  Form: async () => {
    const module = await import('./Form');

    return module.default;
  },
};

export default companyService;
