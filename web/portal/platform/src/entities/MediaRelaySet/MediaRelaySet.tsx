import PlayLessonIcon from '@mui/icons-material/PlayLesson';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';
import Form from './Form';
import {
  MediaRelaySetProperties,
  MediaRelaySetPropertyList,
} from './MediaRelaySetProperties';
import { EntityValue } from '@irontec/ivoz-ui';

const properties: MediaRelaySetProperties = {
  description: {
    label: _('Description'),
  },
  name: {
    label: _('Name'),
  },
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
  selectOptions,
  Form,
};

export default MediaRelaySet;
