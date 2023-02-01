import CallIcon from '@mui/icons-material/Call';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';
import Form from './Form';
import {
  TerminalModelProperties,
  TerminalModelPropertyList,
} from './TerminalModelProperties';
import { EntityValue } from '@irontec/ivoz-ui';

const properties: TerminalModelProperties = {
  description: {
    label: _('Description'),
  },
  iden: {
    label: _('Iden'),
  },
  name: {
    label: _('Name'),
  },
  genericUrlPattern: {
    label: _('Generic URL Pattern'),
    prefix: 'http://{PROVISIONING_URL}/provision/',
  },
  specificUrlPattern: {
    label: _('Specific URL Pattern'),
    prefix:
      'https://{PROVISIONING_URL}:{PORT_IN_GENERIC_FILE}/provision/{OPTIONAL_SUBPATHS}/',
  },
  genericTemplate: {
    label: _('Generic Template'),
    format: 'textarea',
  },
  specificTemplate: {
    label: _('Specific Template'),
    format: 'textarea',
  },
};

const TerminalModel: EntityInterface = {
  ...defaultEntityBehavior,
  icon: CallIcon,
  iden: 'TerminalModel',
  title: _('Terminal Model', { count: 2 }),
  path: '/terminal_models',
  toStr: (row: TerminalModelPropertyList<EntityValue>) => row.iden as string,
  properties,
  columns: [
    'iden',
    'name',
    'description',
    'genericUrlPattern',
    'specificUrlPattern',
  ],
  selectOptions,
  Form,
};

export default TerminalModel;
