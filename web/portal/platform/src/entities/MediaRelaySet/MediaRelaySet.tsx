import { EntityValue, isEntityItem } from '@irontec/ivoz-ui';
import DeleteRowButton from '@irontec/ivoz-ui/components/List/Content/CTA/DeleteRowButton';
import EditRowButton from '@irontec/ivoz-ui/components/List/Content/CTA/EditRowButton';
import defaultEntityBehavior, {
  ChildDecorator as DefaultChildDecorator,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface, {
  ChildDecoratorType,
} from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import PlayLessonIcon from '@mui/icons-material/PlayLesson';

import {
  MediaRelaySetProperties,
  MediaRelaySetPropertyList,
} from './MediaRelaySetProperties';

const properties: MediaRelaySetProperties = {
  description: {
    label: _('Description'),
  },
  name: {
    label: _('Name'),
  },
};

const ChildDecorator: ChildDecoratorType = (props) => {
  const { routeMapItem, row, entityService } = props;

  const isMediaRelaySet =
    isEntityItem(routeMapItem) &&
    routeMapItem.entity.iden === MediaRelaySet.iden;

  const isDeletePath = routeMapItem.route === `${MediaRelaySet.path}/:id`;
  const isUpdatePath =
    routeMapItem.route === `${MediaRelaySet.path}/:id/update`;

  const isDefaultMediaRelaySet = row.id === 0;

  if (isMediaRelaySet && isDefaultMediaRelaySet) {
    if (isUpdatePath) {
      return <EditRowButton disabled={true} row={row} path={''} />;
    }

    if (isDeletePath) {
      return (
        <DeleteRowButton
          disabled={true}
          row={row}
          entityService={entityService}
        />
      );
    }
  }

  return DefaultChildDecorator(props);
};

const MediaRelaySet: EntityInterface = {
  ...defaultEntityBehavior,
  icon: PlayLessonIcon,
  link: '/doc/en/administration_portal/platform/infrastructure/media_relay_sets.html',
  iden: 'MediaRelaySet',
  title: _('Media Relay Set', { count: 2 }),
  path: '/media_relay_sets',
  toStr: (row: MediaRelaySetPropertyList<EntityValue>) => row.name as string,
  properties,
  columns: ['name', 'description'],
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'MediaRelaySets',
  },
  ChildDecorator,
  selectOptions: async () => {
    const module = await import('./SelectOptions');

    return module.default;
  },
  Form: async () => {
    const module = await import('./Form');

    return module.default;
  },
};

export default MediaRelaySet;
