import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import { PartialPropertyList } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import QuickreplyIcon from '@mui/icons-material/Quickreply';

const properties: PartialPropertyList = {
  name: {
    label: _('Name'),
  },
  defaultAction: {
    label: _('Default Action'),
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
  forcedDdi: {
    label: _('Forced DDI'),
    null: _("Client's default"),
    default: '__null__',
  },
};

const columns = ['name', 'defaultAction', 'forcedDdi'];

const outgoingDdiRule: EntityInterface = {
  ...defaultEntityBehavior,
  icon: QuickreplyIcon,
  link: '/doc/${language}/administration_portal/client/vpbx/user_configuration/outgoing_ddi_rules.html',
  iden: 'OutgoingDdiRule',
  title: _('Outgoing DDI Rule', { count: 2 }),
  path: '/outgoing_ddi_rules',
  properties,
  columns,
  defaultOrderBy: '',
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'OutgoingDDIRules',
  },
  selectOptions: async () => {
    const module = await import('./SelectOptions');

    return module.default;
  },
  Form: async () => {
    const module = await import('./Form');

    return module.default;
  },
};

export default outgoingDdiRule;
