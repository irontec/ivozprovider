import { isEntityItem } from '@irontec/ivoz-ui';
import ChildEntityLink from '@irontec/ivoz-ui/components/List/Content/Shared/ChildEntityLink';
import defaultEntityBehavior, {
  ChildDecorator as DefaultChildDecorator,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface, {
  ChildDecoratorType,
  OrderDirection,
} from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import ChatBubbleOutlineIcon from '@mui/icons-material/ChatBubbleOutline';

import Actions from './Action';
import { UsersCdrProperties } from './UsersCdrProperties';

const properties: UsersCdrProperties = {
  startTime: {
    label: _('Start time'),
    readOnly: true,
  },
  owner: {
    label: _('Owner'),
    readOnly: true,
    memoize: false,
  },
  duration: {
    label: _('Duration'),
    readOnly: true,
  },
  direction: {
    label: _('Direction'),
    enum: {
      inbound: _('Inbound'),
      outbound: _('Outbound'),
    },
    readOnly: true,
  },
  caller: {
    label: _('Source'),
    readOnly: true,
  },
  callee: {
    label: _('Destination'),
    readOnly: true,
  },
  disposition: {
    label: _('Disposition'),
    enum: {
      answered: _('Answered'),
      missed: _('Missed'),
      busy: _('Busy'),
      error: _('Error'),
    },
    readOnly: true,
  },
};

const columns = [
  'startTime',
  'owner',
  'direction',
  'caller',
  'callee',
  'duration',
  'disposition',
];

export const ChildDecorator: ChildDecoratorType = (props) => {
  const { routeMapItem, row } = props;

  const recording = routeMapItem.entity;
  const isDetailedPath =
    routeMapItem.route === `${recording.path}/:id/detailed`;
  const isUpdatePath = routeMapItem.route === `${recording.path}/:id/update`;
  const isDeletePath = routeMapItem.route === `${recording.path}/:id`;

  if (isDetailedPath || isUpdatePath || isDeletePath) {
    return null;
  }
  if (
    isEntityItem(routeMapItem) &&
    routeMapItem.entity.iden === recording.iden
  ) {
    if (row.numRecordings < 1) {
      return (
        <ChildEntityLink
          row={row}
          routeMapItem={routeMapItem}
          disabled={true}
        />
      );
    }
  }

  return DefaultChildDecorator(props);
};

const usersCdr: EntityInterface = {
  ...defaultEntityBehavior,
  icon: ChatBubbleOutlineIcon,
  link: '/doc/${language}/administration_portal/client/vpbx/calls/call_registry.html',
  iden: 'UsersCdr',
  title: _('Call registry', { count: 2 }),
  path: '/users_cdrs',
  properties,
  columns,
  customActions: Actions,
  acl: {
    update: false,
    create: false,
    read: true,
    detail: false,
    delete: false,
    iden: 'UsersCdrs',
  },
  ChildDecorator,
  defaultOrderBy: 'startTime',
  defaultOrderDirection: OrderDirection.desc,
  foreignKeyResolver: async () => {
    const module = await import('./ForeignKeyResolver');

    return module.default;
  },
};

export default usersCdr;
