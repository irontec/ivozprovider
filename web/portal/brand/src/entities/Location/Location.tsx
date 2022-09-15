import AccountTreeIcon from '@mui/icons-material/AccountTree';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { LocationProperties } from './LocationProperties';

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
  toStr: (row: any) => row.name,
  properties,
};

export default Location;
