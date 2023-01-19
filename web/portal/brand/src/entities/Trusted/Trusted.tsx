import MeetingRoomIcon from '@mui/icons-material/MeetingRoom';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';
import Form from './Form';
import { TrustedProperties } from './TrustedProperties';

const properties: TrustedProperties = {
  srcIp: {
    label: _('Src Ip'),
  },
  proto: {
    label: _('Proto'),
  },
  fromPattern: {
    label: _('From Pattern'),
  },
  ruriPattern: {
    label: _('R-URI pattern'),
  },
  tag: {
    label: _('Tag'),
  },
  description: {
    label: _('Description'),
  },
  priority: {
    label: _('Priority'),
  },
  id: {
    label: _('Id'),
  },
  company: {
    label: _('Company', { count: 1 }),
  },
};

const Trusted: EntityInterface = {
  ...defaultEntityBehavior,
  icon: MeetingRoomIcon,
  iden: 'Trusted',
  title: _('Trusted'),
  path: '/trusteds',
  toStr: (row: any) => row.id,
  properties,
  selectOptions,
  Form,
};

export default Trusted;
