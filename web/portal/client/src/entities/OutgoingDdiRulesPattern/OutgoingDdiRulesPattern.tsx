import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import PhoneCallbackIcon from '@mui/icons-material/PhoneCallback';

import ForcedDdiStr from './Field/ForcedDdiStr';
import Rule from './Field/Rule';
import { OutgoingDdiRulesPatternProperties } from './OutgoingDdiRulesPatternProperties';

const properties: OutgoingDdiRulesPatternProperties = {
  outgoingDdiRule: {
    label: _('Outgoing DDI Rule Pattern'),
    //required: true
  },
  type: {
    label: _('Type'),
    //required: true
    enum: {
      prefix: _('Prefix'),
      destination: _('Destination'),
    },
    visualToggle: {
      prefix: {
        show: ['prefix'],
        hide: ['matchList'],
      },
      destination: {
        show: ['matchList'],
        hide: ['prefix'],
      },
    },
  },
  prefix: {
    label: _('Prefix'),
    pattern: new RegExp('^[0-9]{1,3}[*]$'),
    //required: true
    //default: true
    helpText: _('From 1 to 3 digits ended by * symbol'),
  },
  matchList: {
    label: _('Match List'),
    //required: true
    null: _('Unassigned'),
    default: '__null__',
  },
  action: {
    label: _('Action'),
    // required: true
    enum: {
      keep: _('Keep Original DDI'),
      force: _('Force DDI'),
    },
    visualToggle: {
      keep: {
        show: [],
        hide: ['forcedDdi'],
      },
      force: {
        show: ['forcedDdi'],
        hide: [],
      },
    },
  },
  forcedDdiStr: {
    label: _('Forced DDI'),
    component: ForcedDdiStr,
  },
  forcedDdi: {
    label: _('Forced DDI'),
    null: _('Unassigned'),
    default: '__null__',
  },
  priority: {
    label: _('Priority'),
    default: 1,
  },
  rule: {
    label: _('Rule'),
    component: Rule,
  },
};

const OutgoingDdiRulesPattern: EntityInterface = {
  ...defaultEntityBehavior,
  icon: PhoneCallbackIcon,
  iden: 'OutgoingDdiRulesPattern',
  title: _('Outgoing DDI Rule Pattern', { count: 2 }),
  path: '/outgoing_ddi_rules_patterns',
  properties,
  columns: ['priority', 'type', 'rule', 'action', 'forcedDdiStr'],
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'OutgoingDDIRulesPatterns',
  },
  selectOptions: async () => {
    const module = await import('./SelectOptions');

    return module.default;
  },
  foreignKeyResolver: async () => {
    const module = await import('./ForeignKeyResolver');

    return module.default;
  },
  Form: async () => {
    const module = await import('./Form');

    return module.default;
  },
};

export default OutgoingDdiRulesPattern;
