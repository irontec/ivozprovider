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
  create: {
    label: _('Create'),
    default: 0,
    enum: {
      '0': _('No'),
      '1': _('Yes'),
    },
  },
  read: {
    label: _('Read'),
    default: 0,
    enum: {
      '0': _('No'),
      '1': _('Yes'),
    },
  },
  update: {
    label: _('Update'),
    default: 0,
    enum: {
      '0': _('No'),
      '1': _('Yes'),
    },
  },
  delete: {
    label: _('Delete'),
    default: 0,
    enum: {
      '0': _('No'),
      '1': _('Yes'),
    },
  },
  administrator: {
    label: _('Administrator'),
    readOnly: true,
  },
  publicEntity: {
    label: _('Entity'),
    readOnly: true,
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
  selectOptions,
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default AdministratorRelPublicEntity;
