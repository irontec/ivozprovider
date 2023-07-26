import { Edit, RouteSpec } from '@irontec/ivoz-ui';

const addCustomRoutes = (routes: Array<RouteSpec>): Array<RouteSpec> => {
  const preferencesRoute = routes.find((route) => {
    return route.path === '/my/preferences';
  }) as RouteSpec;
  preferencesRoute.component = Edit;

  const accountRoute = routes.find((route) => {
    return route.path === '/my/account';
  }) as RouteSpec;
  accountRoute.component = Edit;

  return routes;
};

export default addCustomRoutes;
