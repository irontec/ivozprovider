import PhoneCallbackIcon from '@mui/icons-material/PhoneCallback';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import Form from './Form';
import { foreignKeyGetter } from './foreignKeyGetter';
import { PickUpGroupProperties } from './PickUpGroupProperties';
import foreignKeyResolver from './foreignKeyResolver';
import selectOptions from './SelectOptions';

const properties: PickUpGroupProperties = {
  name: {
    label: _('Name'),
    required: true,
  },
  userIds: {
    label: _('User'),
    memoize: false,
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
  Form,
  foreignKeyGetter,
  foreignKeyResolver,
  selectOptions: (props, customProps) => {
    return selectOptions(props, customProps);
  },
};

export default pickUpGroup;
