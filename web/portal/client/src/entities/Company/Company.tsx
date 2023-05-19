import { EntityValue } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import AccountTreeIcon from '@mui/icons-material/AccountTree';

import { CompanyProperties, CompanyPropertyList } from './CompanyProperties';

const properties: CompanyProperties = {
  type: {
    label: _('Type'),
    enum: {
      vpbx: _('Vpbx'),
      retail: _('Retail'),
      wholesale: _('Wholesale'),
      residential: _('Residential'),
    },
  },
  name: {
    label: _('Name'),
  },
  domainUsers: {
    label: _('Domain Users'),
  },
  onDemandRecordCode: {
    label: _('On DemandRecordCode'),
  },
  balance: {
    label: _('Balance'),
  },
  id: {
    label: _('Id'),
  },
  invoicing: {
    label: _('Invoicing'),
  },
  language: {
    label: _('Language'),
  },
  defaultTimezone: {
    label: _('Default Timezone'),
  },
  country: {
    label: _('Country'),
  },
  transformationRuleSet: {
    label: _('Transformation RuleSet'),
  },
  outgoingDdi: {
    label: _('Outgoing Ddi'),
  },
  outgoingDdiRule: {
    label: _('Outgoing DdiRule'),
  },
  domainName: {
    label: _('Domain Name'),
  },
};

const Company: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AccountTreeIcon,
  iden: 'Company',
  title: _('Company', { count: 2 }),
  path: '/companies',
  toStr: (row: CompanyPropertyList<EntityValue>) => (row?.name as string) || '',
  properties,
  selectOptions: async () => {
    const module = await import('./SelectOptions');

    return module.default;
  },
  Form: async () => {
    const module = await import('./Form');

    return module.default;
  },
};

export default Company;
