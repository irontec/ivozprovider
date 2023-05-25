import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import FormatListNumberedIcon from '@mui/icons-material/FormatListNumbered';

import {
  QueueMemberProperties,
  QueueMemberPropertyList,
} from './QueueMemberProperties';

const properties: QueueMemberProperties = {
  queue: {
    label: _('Queue'),
    null: _('Unassigned'),
    default: '__null__',
  },
  user: {
    label: _('User'),
    null: _('Unassigned'),
    default: '__null__',
  },
  penalty: {
    label: _('Penalty'),
    required: true,
    minimum: 1,
    helpText: _(
      'Members of lower penalty will be called first. Higher penalty members will be contacted if no members of current penalty are available'
    ),
  },
};

const QueueMember: EntityInterface = {
  ...defaultEntityBehavior,
  icon: FormatListNumberedIcon,
  iden: 'QueueMember',
  title: _('Queue Member', { count: 2 }),
  path: '/queue_members',
  toStr: (row: QueueMemberPropertyList<string>) => `${row.id}`,
  properties,
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'QueueMembers',
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

export default QueueMember;
