import { EntityValues } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import MeetingRoomIcon from '@mui/icons-material/MeetingRoom';

import { TrustedProperties, TrustedPropertyList } from './TrustedProperties';

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
  toStr: (row: TrustedPropertyList<EntityValues>) => `${row?.id}`,
  properties,
  selectOptions: async () => {
    const module = await import('./SelectOptions');

    return module.default;
  },
  Form: async () => {
    const module = await import('./Form');

    return module.default;
  },
};

export default Trusted;
