import { EntityValue } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import CallIcon from '@mui/icons-material/Call';

import {
  TerminalModelProperties,
  TerminalModelPropertyList,
} from './TerminalModelProperties';

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
    helpText: 'http://{PROVISIONING_URL}/provision/',
  },
  specificUrlPattern: {
    label: _('Specific URL Pattern'),
    helpText:
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
  selectOptions: async () => {
    const module = await import('./SelectOptions');

    return module.default;
  },
  Form: async () => {
    const module = await import('./Form');

    return module.default;
  },
};

export default TerminalModel;
