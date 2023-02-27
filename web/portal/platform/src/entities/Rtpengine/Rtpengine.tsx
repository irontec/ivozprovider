import PlayLessonIcon from '@mui/icons-material/PlayLesson';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';
import Form from './Form';
import {
  RtpengineProperties,
  RtpenginePropertyList,
} from './RtpengineProperties';
import { EntityValue } from '@irontec/ivoz-ui';

const properties: RtpengineProperties = {
  url: {
    label: _('URL'),
  },
  weight: {
    label: _('Weight'),
  },
  description: {
    label: _('Description'),
  },
  disabled: {
    label: _('Disabled'),
  },
};

const Rtpengine: EntityInterface = {
  ...defaultEntityBehavior,
  icon: PlayLessonIcon,
  iden: 'Rtpengine',
  title: _('Media Relay', { count: 2 }),
  path: '/rtpengines',
  toStr: (row: RtpenginePropertyList<EntityValue>) => row.url as string,
  properties,
  columns: ['url', 'weight', 'description', 'disabled'],
  selectOptions,
  Form,
};

export default Rtpengine;
