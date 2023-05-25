import { EntityValues } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import DynamicFormIcon from '@mui/icons-material/DynamicForm';

import {
  DdiProviderProperties,
  DdiProviderPropertyList,
} from './DdiProviderProperties';

const properties: DdiProviderProperties = {
  description: {
    label: _('Description'),
    required: false,
  },
  name: {
    label: _('Name'),
  },
  transformationRuleSet: {
    label: _('Numeric transformation', { count: 1 }),
    default: 252,
  },
  proxyTrunk: {
    label: _('Local socket'),
    helpText: _('Local address used in SIP signalling with this DDI Provider.'),
  },
  mediaRelaySets: {
    label: _('Media relay Set'),
    default: '__null__',
    null: _("Client's default"),
  },
};

const DdiProvider: EntityInterface = {
  ...defaultEntityBehavior,
  icon: DynamicFormIcon,
  iden: 'DdiProvider',
  title: _('DDI Provider', { count: 2 }),
  path: '/ddi_providers',
  toStr: (row: DdiProviderPropertyList<EntityValues>) => `${row.name}`,
  properties,
  columns: [
    'name',
    'description',
    'transformationRuleSet',
    //@TODO 'balance',
    'proxyTrunk',
    //@TODO status
  ],
  selectOptions: async () => {
    const module = await import('./SelectOptions');

    return module.default;
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

export default DdiProvider;
