import { EntityValue } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import FaxIcon from '@mui/icons-material/Fax';

import {
  TerminalManufacturerProperties,
  TerminalManufacturerPropertyList,
} from './TerminalManufacturerProperties';

const properties: TerminalManufacturerProperties = {
  description: {
    label: _('Description'),
  },
  iden: {
    label: _('Iden'),
  },
  name: {
    label: _('Name'),
  },
};

const TerminalManufacturer: EntityInterface = {
  ...defaultEntityBehavior,
  icon: FaxIcon,
  link: '/doc/${language}/administration_portal/platform/terminal_manufacturers.html',
  iden: 'TerminalManufacturer',
  title: _('Terminal Manufacturer', { count: 2 }),
  path: '/terminal_manufacturers',
  toStr: (row: TerminalManufacturerPropertyList<EntityValue>) =>
    row.iden as string,
  properties,
  columns: ['iden', 'name', 'description'],
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'TerminalManufacturers',
  },
  selectOptions: async () => {
    const module = await import('./SelectOptions');

    return module.default;
  },
  Form: async () => {
    const module = await import('./Form');

    return module.default;
  },
  defaultOrderBy: '',
};

export default TerminalManufacturer;
