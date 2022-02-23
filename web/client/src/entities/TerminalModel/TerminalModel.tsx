import SettingsApplications from '@mui/icons-material/SettingsApplications';
import EntityInterface from 'lib/entities/EntityInterface';
import defaultEntityBehavior from 'lib/entities/DefaultEntityBehavior';
import _ from 'lib/services/translations/translate';
import { PartialPropertyList } from 'lib/services/api/ParsedApiSpecInterface';
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