import defaultEntityBehavior from '@irontec-voip/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec-voip/ivoz-ui/entities/EntityInterface';
import _ from '@irontec-voip/ivoz-ui/services/translations/translate';
import FormatListNumberedIcon from '@mui/icons-material/FormatListNumbered';

import { FriendsPatternProperties } from './FriendsPatternProperties';

const properties: FriendsPatternProperties = {
  friend: {
    label: _('Friend', { count: 1 }),
  },
  name: {
    label: _('Name'),
  },
  regExp: {
    label: _('Regular Expression'),
    helpText: _(
      'Avoid PCRE regular expressions here: use [0-9] instead of \\d.'
    ),
  },
};

const FriendsPattern: EntityInterface = {
  ...defaultEntityBehavior,
  icon: FormatListNumberedIcon,
  iden: 'FriendsPattern',
  title: _('Friend Pattern', { count: 2 }),
  path: '/friends_patterns',
  properties,
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'FriendsPatterns',
  },
  Form: async () => {
    const module = await import('./Form');

    return module.default;
  },
};

export default FriendsPattern;
