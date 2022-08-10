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
  name: {
    label: _('Name'),
    maxLength: 55,
  },
  description: {
    label: _('Description'),
    maxLength: 55,
  },
  patternIds: {
    label: _('Routing pattern'),
    //@TODO multiselect
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
  selectOptions,
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default RoutingPatternGroup;
