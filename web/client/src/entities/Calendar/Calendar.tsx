import CalendarTodayIcon from '@mui/icons-material/CalendarToday';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { CalendarProperties } from './CalendarProperties';
import { EntityValues } from '@irontec/ivoz-ui/services/entity/EntityService';
import selectOptions from './SelectOptions';

const properties: CalendarProperties = {
    'name': {
        label: 'Name'
    },
};

const calendar: EntityInterface = {
    ...defaultEntityBehavior,
    icon: CalendarTodayIcon,
    iden: 'Calendar',
    title: _('Calendar', { count: 2 }),
    path: '/calendars',
    properties,
    acl: {
        ...defaultEntityBehavior.acl,
        iden: 'Calendars',
    },
    toStr: (row: EntityValues) => (row?.name as string | ''),
    selectOptions: (props, customProps) => { return selectOptions(props, customProps); },
};

export default calendar;