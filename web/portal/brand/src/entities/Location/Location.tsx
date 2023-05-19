import { EntityValues } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import AccountTreeIcon from '@mui/icons-material/AccountTree';

import { LocationProperties, LocationPropertyList } from './LocationProperties';

const properties: LocationProperties = {
  name: {
    label: _('Name'),
  },
};

const Location: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AccountTreeIcon,
  iden: 'Location',
  title: _('Location', { count: 2 }),
  path: '/locations',
  toStr: (row: LocationPropertyList<EntityValues>) => `${row.name}`,
  properties,
};

export default Location;
