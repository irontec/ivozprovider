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
import RingVolumeIcon from '@mui/icons-material/RingVolume';

import Actions from './Action';
import Duration from './Field/Duration';
import { UsersCdrProperties, UsersCdrPropertyList } from './UsersCdrProperties';

const properties: UsersCdrProperties = {
  startTime: {
    label: _('Start Time'),
  },
  owner: {
    label: _('Owner'),
    readOnly: true,
    memoize: false,
  },
  duration: {
    label: _('Duration'),
    component: Duration,
  },
  direction: {
    label: _('Direction'),
    enum: {
      inbound: _('Inbound'),
      outbound: _('Outbound'),
    },
  },
  caller: {
    label: _('Caller'),
  },
  callee: {
    label: _('Callee'),
  },
  disposition: {
    label: _('Disposition'),
    enum: {
      answered: _('Answered'),
      missed: _('Missed'),
      busy: _('Busy'),
    },
    readOnly: true,
  },
  id: {
    label: _('Id'),
  },
};

const columns = [
  'startTime',
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

const UsersCdr: EntityInterface = {
  ...defaultEntityBehavior,
  icon: RingVolumeIcon,
  iden: 'UsersCdr',
  title: _('Call', { count: 2 }),
  path: '/my/call_history',
  toStr: (row: UsersCdrPropertyList<string>) => `${row.id}`,
  properties,
  acl: {
    create: false,
    delete: false,
    detail: false,
    read: true,
    update: false,
    iden: 'provider_users_cdrs',
  },
  defaultOrderBy: 'startTime',
  ChildDecorator,
  defaultOrderDirection: OrderDirection.desc,
  columns,
  customActions: Actions,
  Form: async () => {
    const module = await import('./Form');

    return module.default;
  },
};

export default UsersCdr;
