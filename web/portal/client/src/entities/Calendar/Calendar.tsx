import { isEntityItem } from '@irontec/ivoz-ui';
import defaultEntityBehavior, {
  ChildDecorator as DefaultChildDecorator,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface, {
  ChildDecoratorType,
} from '@irontec/ivoz-ui/entities/EntityInterface';
import { EntityValues } from '@irontec/ivoz-ui/services/entity/EntityService';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import CalendarTodayIcon from '@mui/icons-material/CalendarToday';

import HolidayDateRange from '../HolidayDateRange/HolidayDateRange';
import { CalendarProperties } from './CalendarProperties';

const properties: CalendarProperties = {
  name: {
    label: 'Name',
  },
};

export const ChildDecorator: ChildDecoratorType = (props) => {
  const { routeMapItem } = props;

  if (
    isEntityItem(routeMapItem) &&
    routeMapItem.entity.iden === HolidayDateRange.iden
  ) {
    return null;
  }

  return DefaultChildDecorator(props);
};

const calendar: EntityInterface = {
  ...defaultEntityBehavior,
  icon: CalendarTodayIcon,
  link: '/doc/en/administration_portal/client/vpbx/routing_tools/calendars.html',
  iden: 'Calendar',
  title: _('Calendar', { count: 2 }),
  path: '/calendars',
  properties,
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'Calendars',
  },
  ChildDecorator,
  toStr: (row: EntityValues) => row?.name as string | '',
  selectOptions: async () => {
    const module = await import('./SelectOptions');

    return module.default;
  },
};

export default calendar;
