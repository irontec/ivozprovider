import AccountTreeIcon from '@mui/icons-material/AccountTree';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';
import Form from './Form';
import { foreignKeyGetter } from './ForeignKeyGetter';
import { AdministratorRelPublicEntityProperties } from './AdministratorRelPublicEntityProperties';
import foreignKeyResolver from './ForeignKeyResolver';

const properties: AdministratorRelPublicEntityProperties = {
  'create': {
    label: _('Create'),
  },
  'read': {
    label: _('Read'),
  },
  'update': {
    label: _('Update'),
  },
  'delete': {
    label: _('Delete'),
  },
  'id': {
    label: _('Id'),
  },
  'administrator': {
    label: _('Administrator'),
  },
  'publicEntity': {
    label: _('Public Entity'),
  },
};

const AdministratorRelPublicEntity: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AccountTreeIcon,
  iden: 'AdministratorRelPublicEntity',
  title: _('AdministratorRelPublicEntity', { count: 2 }),
  path: '/AdministratorRelPublicEntities',
  toStr: (row: any) => row.id,
  properties,
  selectOptions: (props, customProps) => { return selectOptions(props, customProps); },
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default AdministratorRelPublicEntity;