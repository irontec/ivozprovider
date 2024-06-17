import { EntityValues } from '@irontec-voip/ivoz-ui';
import defaultEntityBehavior from '@irontec-voip/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec-voip/ivoz-ui/entities/EntityInterface';
import _ from '@irontec-voip/ivoz-ui/services/translations/translate';
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
  defaultOrderBy: '',
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'Locations',
  },
};

export default Location;
