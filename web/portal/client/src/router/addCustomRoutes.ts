import { Create, RouteSpec } from '@irontec/ivoz-ui';

import ActiveCallsComponent from '../components/ActiveCalls';
import HolidayDateRange from '../entities/HolidayDateRange/HolidayDateRange';

const addCustomRoutes = (routes: Array<RouteSpec>): Array<RouteSpec> => {
  const activeCallsRoute = routes.find(
    (route) => route.key === 'ActiveCalls-list'
  );

  if (activeCallsRoute) {
    activeCallsRoute.component = ActiveCallsComponent;
  }

  routes.push({
    component: Create,
    entity: HolidayDateRange,
    key: 'HolidayDateRange-create',
    path: `/calendars/:parent_id_1${HolidayDateRange.path}`,
  });

  return routes;
};

export default addCustomRoutes;
