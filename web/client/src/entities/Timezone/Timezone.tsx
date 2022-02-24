import AccountTreeIcon from '@mui/icons-material/AccountTree';
import EntityInterface from 'lib/entities/EntityInterface';
import _ from 'lib/services/translations/translate';
import defaultEntityBehavior from 'lib/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';

const timezone: EntityInterface = {
    ...defaultEntityBehavior,
    icon: AccountTreeIcon,
    iden: 'Timezone',
    title: _('Timezone', { count: 2 }),
    path: '/timezone',
    toStr: (row: any) => row.name,
    selectOptions: (props, customProps) => { return selectOptions(props, customProps); },
};

export default timezone;