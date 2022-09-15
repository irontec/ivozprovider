import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import PlumbingIcon from '@mui/icons-material/Plumbing';
import { foreignKeyGetter } from './ForeignKeyGetter';
import foreignKeyResolver from './ForeignKeyResolver';
import Form from './Form';
import selectOptions from './SelectOptions';
import { ServiceProperties } from './ServiceProperties';

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
  toStr: (row: any) => row.name.en,
  properties,
  columns: ['iden', 'defaultCode'],
  selectOptions,
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default Service;
