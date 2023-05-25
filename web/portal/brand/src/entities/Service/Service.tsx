import { EntityValues } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import PlumbingIcon from '@mui/icons-material/Plumbing';

import { ServiceProperties, ServicePropertyList } from './ServiceProperties';

const properties: ServiceProperties = {
  iden: {
    label: _('Iden'),
  },
  defaultCode: {
    label: _('Code'),
    prefix: '*',
    pattern: new RegExp('/[#0-9*]+/'),
    helpText: _(
      'Future brands will have services enabled with this codes by default'
    ),
  },
  extraArgs: {
    label: _('Service has extra arguments'),
    enum: {
      '0': _('No'),
      '1': _('Yes'),
    },
  },
  name: {
    label: _('Name'),
  },
  description: {
    label: _('Description'),
  },
};

const Service: EntityInterface = {
  ...defaultEntityBehavior,
  icon: PlumbingIcon,
  iden: 'Service',
  title: _('Service', { count: 2 }),
  path: '/services',
  toStr: (row: ServicePropertyList<EntityValues>) => `${row.name?.en}`,
  properties,
  columns: ['iden', 'defaultCode'],
  selectOptions: async () => {
    const module = await import('./SelectOptions');

    return module.default;
  },
  foreignKeyResolver: async () => {
    const module = await import('./ForeignKeyResolver');

    return module.default;
  },
  foreignKeyGetter: async () => {
    const module = await import('./ForeignKeyGetter');

    return module.foreignKeyGetter;
  },
  Form: async () => {
    const module = await import('./Form');

    return module.default;
  },
};

export default Service;
