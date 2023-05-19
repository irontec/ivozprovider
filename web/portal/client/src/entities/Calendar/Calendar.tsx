import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import { EntityValues } from '@irontec/ivoz-ui/services/entity/EntityService';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import CalendarTodayIcon from '@mui/icons-material/CalendarToday';

import { CalendarProperties } from './CalendarProperties';

const properties: CalendarProperties = {
  name: {
    label: 'Name',
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
  toStr: (row: EntityValues) => row?.name as string | '',
  selectOptions: async () => {
    const module = await import('./SelectOptions');

    return module.default;
  },
};

export default calendar;
