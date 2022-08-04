import { RouteSpec } from '@irontec/ivoz-ui';
import ActiveCallsComponent from '../components/ActiveCalls';

const addCustomRoutes = (routes: Array<RouteSpec>): Array<RouteSpec> => {
  const activeCallsRoute = routes.find(
    (route) => route.key === 'ActiveCalls-list'
  );

  if (activeCallsRoute) {
    activeCallsRoute.component = ActiveCallsComponent;
  }

  return routes;
};

export default addCustomRoutes;
