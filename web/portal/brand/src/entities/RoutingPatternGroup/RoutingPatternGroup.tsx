import AccountTreeIcon from '@mui/icons-material/AccountTree';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';
import Form from './Form';
import { foreignKeyGetter } from './ForeignKeyGetter';
import { RoutingPatternGroupProperties } from './RoutingPatternGroupProperties';
import foreignKeyResolver from './ForeignKeyResolver';

const properties: RoutingPatternGroupProperties = {
  'name': {
    label: _('Name'),
  },
  'description': {
    label: _('Description'),
  },
  'id': {
    label: _('Id'),
  },
  'patternIds': {
    label: _('Pattern Ids'),
  },
};

const RoutingPatternGroup: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AccountTreeIcon,
  iden: 'RoutingPatternGroup',
  title: _('RoutingPatternGroup', { count: 2 }),
  path: '/RoutingPatternGroups',
  toStr: (row: any) => row.id,
  properties,
  selectOptions: (props, customProps) => { return selectOptions(props, customProps); },
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default RoutingPatternGroup;