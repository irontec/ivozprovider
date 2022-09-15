import AccountTreeIcon from '@mui/icons-material/AccountTree';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';
import { OutgoingDdiRuleProperties } from './OutgoingDdiRuleProperties';

const properties: OutgoingDdiRuleProperties = {
  name: {
    label: _('Name'),
  },
  defaultAction: {
    label: _('Default Action'),
    enum: {
      keep: _('Keep'),
      force: _('Force'),
    },
  },
  company: {
    label: _('Company'),
  },
  forcedDdi: {
    label: _('Forced Ddi'),
  },
};

const OutgoingDdiRule: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AccountTreeIcon,
  iden: 'OutgoingDdiRule',
  title: _('Outgoing DDI Rule', { count: 2 }),
  path: '/outgoing_ddi_rules',
  toStr: (row: any) => row.name,
  properties,
  selectOptions,
};

export default OutgoingDdiRule;
