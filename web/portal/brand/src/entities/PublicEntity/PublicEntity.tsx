import AccountTreeIcon from '@mui/icons-material/AccountTree';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';
import { PublicEntityProperties } from './PublicEntityProperties';

const properties: PublicEntityProperties = {
  iden: {
    label: _('Iden'),
  },
  fqdn: {
    label: _('Fqdn'),
  },
  platform: {
    label: _('Platform'),
  },
  brand: {
    label: _('Brand'),
  },
  client: {
    label: _('Client'),
  },
  name: {
    label: _('Name'),
  },
};

const PublicEntity: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AccountTreeIcon,
  iden: 'PublicEntity',
  title: _('PublicEntity', { count: 2 }),
  path: '/public_entities',
  toStr: (row: any) => row.name.en,
  properties,
  selectOptions,
};

export default PublicEntity;
