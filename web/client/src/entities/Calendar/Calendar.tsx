import CalendarTodayIcon from '@mui/icons-material/CalendarToday';
import EntityInterface from 'lib/entities/EntityInterface';
import _ from 'lib/services/translations/translate';
import defaultEntityBehavior from 'lib/entities/DefaultEntityBehavior';
import { CalendarProperties } from './CalendarProperties';

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
};

export default calendar;