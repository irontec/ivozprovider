import { EntityValues } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import AccountTreeIcon from '@mui/icons-material/AccountTree';

import {
  PublicEntityProperties,
  PublicEntityPropertyList,
} from './PublicEntityProperties';

const properties: PublicEntityProperties = {
  iden: {
    label: _('Iden'),
  },
  fqdn: {
    label: 'FQDN',
  },
  platform: {
    label: _('Platform'),
  },
  brand: {
    label: _('Brand', { count: 1 }),
  },
  client: {
    label: _('Client', { count: 1 }),
  },
  name: {
    label: _('Name'),
  },
};

const PublicEntity: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AccountTreeIcon,
  iden: 'PublicEntity',
  title: _('Entity', { count: 2 }),
  path: '/public_entities',
  toStr: (row: PublicEntityPropertyList<EntityValues>) =>
    row.name?.en as string,
  properties,
  selectOptions: async () => {
    const module = await import('./SelectOptions');

    return module.default;
  },
};

export default PublicEntity;
