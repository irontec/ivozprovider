import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import ApartmentIcon from '@mui/icons-material/Apartment';

import { LocationProperties, LocationPropertyList } from './LocationProperties';

const properties: LocationProperties = {
  name: {
    label: _('Name'),
  },
  description: {
    label: _('Description'),
  },
};

const columns = ['name', 'description'];

const location: EntityInterface = {
  ...defaultEntityBehavior,
  icon: ApartmentIcon,
  iden: 'Location',
  title: _('Location', { count: 2 }),
  path: '/locations',
  toStr: (row: LocationPropertyList<string>) => row?.name || '',
  properties,
  columns,
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'Locations',
  },
  selectOptions: async () => {
    const module = await import('./SelectOptions');

    return module.default;
  },
  Form: async () => {
    const module = await import('./Form');

    return module.default;
  },
};
export default location;
