import defaultEntityBehavior from '@irontec-voip/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec-voip/ivoz-ui/entities/EntityInterface';
import _ from '@irontec-voip/ivoz-ui/services/translations/translate';
import PhoneCallbackIcon from '@mui/icons-material/PhoneCallback';

import { PickUpGroupProperties } from './PickUpGroupProperties';

const properties: PickUpGroupProperties = {
  name: {
    label: _('Name'),
    required: true,
  },
  userIds: {
    label: _('User', { count: 1 }),
    type: 'array',
    $ref: '#/definitions/User',
  },
};

const pickUpGroup: EntityInterface = {
  ...defaultEntityBehavior,
  icon: PhoneCallbackIcon,
  link: '/doc/en/administration_portal/client/vpbx/user_configuration/pick_up_groups.html',
  iden: 'PickUpGroup',
  title: _('Pickup group', { count: 2 }),
  path: '/pick_up_groups',
  properties,
  defaultOrderBy: '',
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'PickUpGroups',
  },
  selectOptions: async () => {
    const module = await import('./SelectOptions');

    return module.default;
  },
  foreignKeyResolver: async () => {
    const module = await import('./ForeignKeyResolver');

    return module.default;
  },
  Form: async () => {
    const module = await import('./Form');

    return module.default;
  },
};

export default pickUpGroup;
