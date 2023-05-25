import { EntityValues } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import KeyIcon from '@mui/icons-material/Key';

import { AdministratorRelPublicEntityProperties } from './AdministratorRelPublicEntityProperties';

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
  icon: KeyIcon,
  iden: 'AdministratorRelPublicEntity',
  title: _('Administrator access privilege', { count: 2 }),
  path: '/administrator_rel_public_entities',
  toStr: (row: EntityValues): string => row.id as string,
  properties,
  columns: ['publicEntity', 'create', 'read', 'update', 'delete'],
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

export default AdministratorRelPublicEntity;
