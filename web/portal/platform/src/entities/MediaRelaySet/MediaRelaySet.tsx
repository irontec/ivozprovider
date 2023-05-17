import { EntityValue, isEntityItem } from '@irontec/ivoz-ui';
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
  const { routeMapItem, row } = props;

  if (
    isEntityItem(routeMapItem) &&
    routeMapItem.entity.iden === MediaRelaySet.iden
  ) {
    if (row.id === 0) {
      return null;
    }
  }

  return DefaultChildDecorator(props);
};

const MediaRelaySet: EntityInterface = {
  ...defaultEntityBehavior,
  icon: PlayLessonIcon,
  iden: 'MediaRelaySet',
  title: _('Media Relay Set', { count: 2 }),
  path: '/media_relay_sets',
  toStr: (row: MediaRelaySetPropertyList<EntityValue>) => row.name as string,
  properties,
  columns: ['name', 'description'],
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
