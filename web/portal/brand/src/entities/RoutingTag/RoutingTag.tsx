import AccountTreeIcon from '@mui/icons-material/AccountTree';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';
import Form from './Form';
import { foreignKeyGetter } from './ForeignKeyGetter';
import { RoutingTagProperties } from './RoutingTagProperties';
import foreignKeyResolver from './ForeignKeyResolver';

const properties: RoutingTagProperties = {
  'name': {
    label: _('Name'),
  },
  'tag': {
    label: _('Tag'),
  },
  'id': {
    label: _('Id'),
  },
};

const RoutingTag: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AccountTreeIcon,
  iden: 'RoutingTag',
  title: _('RoutingTag', { count: 2 }),
  path: '/RoutingTags',
  toStr: (row: any) => row.id,
  properties,
  selectOptions: (props, customProps) => { return selectOptions(props, customProps); },
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default RoutingTag;