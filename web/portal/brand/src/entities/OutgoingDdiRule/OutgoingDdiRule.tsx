import { EntityValues } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import AccountTreeIcon from '@mui/icons-material/AccountTree';

import {
  OutgoingDdiRuleProperties,
  OutgoingDdiRulePropertyList,
} from './OutgoingDdiRuleProperties';

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
    label: _('Company', { count: 1 }),
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
  toStr: (row: OutgoingDdiRulePropertyList<EntityValues>) => `${row.name}`,
  properties,
  selectOptions: async () => {
    const module = await import('./SelectOptions');

    return module.default;
  },
};

export default OutgoingDdiRule;
