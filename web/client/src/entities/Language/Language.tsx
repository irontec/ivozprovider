import AccountTreeIcon from '@mui/icons-material/AccountTree';
import EntityInterface from 'lib/entities/EntityInterface';
import _ from 'lib/services/translations/translate';
import defaultEntityBehavior from 'lib/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';

const language: EntityInterface = {
    ...defaultEntityBehavior,
    icon: AccountTreeIcon,
    iden: 'Language',
    title: _('Language', { count: 2 }),
    path: '/languages',
    toStr: (row: any) => row.name,
    selectOptions: (props, customProps) => { return selectOptions(props, customProps); },
};

export default language;