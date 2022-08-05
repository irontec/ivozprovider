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
  'description': {
    label: _('Description'),
  },
  'name': {
    label: _('Name'),
  },
  'externallyRated': {
    label: _('Externally Rated'),
  },
  'id': {
    label: _('Id'),
  },
  'transformationRuleSet': {
    label: _('Transformation RuleSet'),
  },
  'proxyTrunk': {
    label: _('Proxy Trunk'),
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
  selectOptions: (props, customProps) => { return selectOptions(props, customProps); },
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default DdiProvider;