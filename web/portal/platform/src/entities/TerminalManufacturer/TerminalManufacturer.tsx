import CallIcon from '@mui/icons-material/Call';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';
import Form from './Form';
import {
  TerminalManufacturerProperties,
  TerminalManufacturerPropertyList,
} from './TerminalManufacturerProperties';
import { EntityValue } from '@irontec/ivoz-ui';

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
  icon: CallIcon,
  iden: 'TerminalManufacturer',
  title: _('Terminal Manufacturer', { count: 2 }),
  path: '/terminal_manufacturers',
  toStr: (row: TerminalManufacturerPropertyList<EntityValue>) =>
    row.iden as string,
  properties,
  columns: ['iden', 'name', 'description'],
  selectOptions,
  Form,
};

export default TerminalManufacturer;
