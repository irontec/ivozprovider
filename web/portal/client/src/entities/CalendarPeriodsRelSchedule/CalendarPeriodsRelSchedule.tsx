import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import DateRangeIcon from '@mui/icons-material/DateRange';

import { CalendarPeriodsRelScheduleProperties } from './CalendarPeriodsRelScheduleProperties';

const properties: CalendarPeriodsRelScheduleProperties = {
  condition: {
    label: 'Condition',
  },
  schedule: {
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
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'CalendarPeriodsRelSchedules',
  },
  selectOptions: async () => {
    const module = await import('./SelectOptions');

    return module.default;
  },
};

export default CalendarPeriod;
