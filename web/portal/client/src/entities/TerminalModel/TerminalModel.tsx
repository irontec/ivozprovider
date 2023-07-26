import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import { PartialPropertyList } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import SettingsApplications from '@mui/icons-material/SettingsApplications';

import { TerminalModelPropertyList } from './TerminalModelProperties';

const properties: PartialPropertyList = {};

export const acl = {
  iden: 'TerminalModels',
  create: false,
  read: true,
  detail: false,
  update: false,
  delete: false,
};

const terminalModel: EntityInterface = {
  ...defaultEntityBehavior,
  icon: SettingsApplications,
  iden: 'TerminalModel',
  title: _('Terminal model', { count: 2 }),
  path: '/terminal_models',
  toStr: (row: TerminalModelPropertyList<string>) => `${row.name}`,
  properties,
  acl,
  selectOptions: async () => {
    const module = await import('./SelectOptions');

    return module.default;
  },
};

export default terminalModel;
