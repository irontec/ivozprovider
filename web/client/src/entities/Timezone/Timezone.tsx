import AccountTreeIcon from '@mui/icons-material/AccountTree';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';

const timezone: EntityInterface = {
    ...defaultEntityBehavior,
    icon: AccountTreeIcon,
    iden: 'Timezone',
    title: _('Timezone', { count: 2 }),
    path: '/timezones',
    toStr: (row: any) => row.name,
    selectOptions: (props, customProps) => { return selectOptions(props, customProps); },
};

export default timezone;