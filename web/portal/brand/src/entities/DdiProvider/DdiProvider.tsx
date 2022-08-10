import AccountTreeIcon from '@mui/icons-material/AccountTree';
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
  },
  name: {
    label: _('Name'),
  },
  externallyRated: {
    label: _('Externally Rated'),
  },
  transformationRuleSet: {
    label: _('Numeric transformation'),
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
  icon: AccountTreeIcon,
  iden: 'DdiProvider',
  title: _('DdiProvider', { count: 2 }),
  path: '/DdiProviders',
  toStr: (row: any) => row.id,
  properties,
  selectOptions,
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default DdiProvider;
