import DynamicFormIcon from '@mui/icons-material/DynamicForm';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';
import Form from './Form';
import { foreignKeyGetter } from './ForeignKeyGetter';
import { DdiProviderProperties } from './DdiProviderProperties';
import foreignKeyResolver from './ForeignKeyResolver';

const properties: DdiProviderProperties = {
  description: {
    label: _('Description'),
    required: false,
  },
  name: {
    label: _('Name'),
  },
  externallyRated: {
    label: _('Externally rated'),
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
  toStr: (row: any) => row.name,
  properties,
  columns: [
    'name',
    'description',
    'transformationRuleSet',
    //@TODO 'balance',
    'proxyTrunk',
    //@TODO status
  ],
  selectOptions,
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default DdiProvider;
