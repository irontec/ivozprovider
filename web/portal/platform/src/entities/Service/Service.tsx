import { EntityValue } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import HomeRepairServiceIcon from '@mui/icons-material/HomeRepairService';
import { getI18n } from 'react-i18next';

import { ServiceProperties, ServicePropertyList } from './ServiceProperties';

const properties: ServiceProperties = {
  iden: {
    label: _('Iden'),
    maxLength: 50,
  },
  name: {
    label: _('Name'),
    maxLength: 50,
    multilang: true,
  },
  description: {
    label: _('Description'),
    maxLength: 255,
    multilang: true,
  },
  defaultCode: {
    label: _('Code'),
    maxLength: 3,
    prefix: '*',
    pattern: new RegExp('^[#0-9]{1,3}$'),
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
    default: 0,
    readOnly: true,
  },
};

const Service: EntityInterface = {
  ...defaultEntityBehavior,
  icon: HomeRepairServiceIcon,
  link: '/doc/en/administration_portal/platform/services.html',
  iden: 'Service',
  title: _('Service', { count: 2 }),
  path: '/services',
  toStr: (row: ServicePropertyList<EntityValue>) => {
    const language = getI18n().language.substring(0, 2);
    const name = row.name as unknown as Record<string, string>;

    return name[language] as string;
  },
  properties,
  columns: ['iden', 'name', 'description', 'defaultCode'],
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'Services',
  },
  selectOptions: async () => {
    const module = await import('./SelectOptions');

    return module.default;
  },
  Form: async () => {
    const module = await import('./Form');

    return module.default;
  },
};

export default Service;
