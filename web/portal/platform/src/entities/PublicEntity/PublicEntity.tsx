import { EntityValues } from '@irontec-voip/ivoz-ui';
import defaultEntityBehavior from '@irontec-voip/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec-voip/ivoz-ui/entities/EntityInterface';
import _ from '@irontec-voip/ivoz-ui/services/translations/translate';
import AccountTreeIcon from '@mui/icons-material/AccountTree';
import { getI18n } from 'react-i18next';

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
    multilang: true,
  },
};

const PublicEntity: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AccountTreeIcon,
  iden: 'PublicEntity',
  title: _('Entity', { count: 2 }),
  path: '/public_entities',
  toStr: (row: PublicEntityPropertyList<EntityValues>) => {
    const language = getI18n().language.substring(0, 2);

    return row.name?.[language] as string;
  },
  properties,
  selectOptions: async () => {
    const module = await import('./SelectOptions');

    return module.default;
  },
};

export default PublicEntity;
