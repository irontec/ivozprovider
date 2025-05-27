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
  userIds: {
    label: _('User', { count: 2 }),
    type: 'array',
    $ref: '#/definitions/User',
    helpText: _('A user can only be linked to a single location'),
  },
  survivalDevice: {
    null: _('Unassigned'),
    label: _('Survival Device', { count: 2 }),
  },
};

const columns = ['name', 'survivalDevice', 'description'];

const location: EntityInterface = {
  ...defaultEntityBehavior,
  icon: ApartmentIcon,
  link: '/doc/${language}/administration_portal/client/vpbx/user_configuration/locations.html',
  iden: 'Location',
  title: _('Location', { count: 2 }),
  path: '/locations',
  toStr: (row: LocationPropertyList<string>) => row?.name || '',
  properties,
  columns,
  defaultOrderBy: '',
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
