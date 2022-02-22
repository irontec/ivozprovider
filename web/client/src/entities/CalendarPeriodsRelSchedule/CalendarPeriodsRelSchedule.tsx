import DateRangeIcon from '@mui/icons-material/DateRange';
import EntityInterface from 'lib/entities/EntityInterface';
import _ from 'lib/services/translations/translate';
import defaultEntityBehavior from 'lib/entities/DefaultEntityBehavior';
import { CalendarPeriodsRelScheduleProperties } from './CalendarPeriodsRelScheduleProperties';
import selectOptions from './SelectOptions';

const properties: CalendarPeriodsRelScheduleProperties = {
    'condition': {
        label: 'Condition',
    },
    'schedule': {
        label: _('Schedule'),
    },
};

const CalendarPeriod: EntityInterface = {
    ...defaultEntityBehavior,
    icon: DateRangeIcon,
    iden: 'CalendarPeriodsRelSchedule',
    title: _('Calendar Period <-> Schedule', { count: 2 }),
    path: '/calendar_periods_rel_schedules',
    properties,
    selectOptions,
};

export default CalendarPeriod;