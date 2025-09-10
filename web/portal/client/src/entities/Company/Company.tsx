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
    label: _('SIP Domain', { count: 1 }),
  },
  onDemandRecordCode: {
    label: _('On-demand Record Code'),
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
    label: _('Language', { count: 1 }),
  },
  defaultTimezone: {
    label: _('Default Timezone'),
  },
  country: {
    label: _('Country', { count: 1 }),
  },
  transformationRuleSet: {
    label: _('Transformation RuleSet', { count: 1 }),
  },
  outgoingDdi: {
    label: _('Outgoing DDI'),
  },
  outgoingDdiRule: {
    label: _('Outgoing DDI Rule', { count: 1 }),
  },
  domainName: {
    label: _('SIP Domain', { count: 1 }),
  },
};

const Company: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AccountTreeIcon,
  iden: 'Company',
  title: _('Client', { count: 2 }),
  path: '/companies',
  toStr: (row: CompanyPropertyList<EntityValue>) => (row?.name as string) || '',
  properties,
  defaultOrderBy: '',
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
