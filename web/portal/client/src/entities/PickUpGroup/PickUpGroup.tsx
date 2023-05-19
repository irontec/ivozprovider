import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import PhoneCallbackIcon from '@mui/icons-material/PhoneCallback';

import { PickUpGroupProperties } from './PickUpGroupProperties';

const properties: PickUpGroupProperties = {
  name: {
    label: _('Name'),
    required: true,
  },
  userIds: {
    label: _('User'),
    type: 'array',
    $ref: '#/definitions/User',
  },
};

const pickUpGroup: EntityInterface = {
  ...defaultEntityBehavior,
  icon: PhoneCallbackIcon,
  iden: 'PickUpGroup',
  title: _('Pick up group', { count: 2 }),
  path: '/pick_up_groups',
  properties,
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
