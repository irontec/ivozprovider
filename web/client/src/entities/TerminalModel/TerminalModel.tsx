import SettingsApplications from '@mui/icons-material/SettingsApplications';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import { PartialPropertyList } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import selectOptions from './SelectOptions';

const properties: PartialPropertyList = {

};

export const acl = {
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
    toStr: (row: any) => row.name,
    properties,
    acl,
    selectOptions: (props, customProps) => { return selectOptions(props, customProps); },
};

export default terminalModel;