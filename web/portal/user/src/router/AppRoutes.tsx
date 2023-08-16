import parseRoutes, { RouteSpec } from '@irontec/ivoz-ui/router/parseRoutes';
import RouteContent from '@irontec/ivoz-ui/router/RouteContent';
import ParsedApiSpecInterface from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import { useEffect, useMemo } from 'react';
import { RouteObject, useRoutes } from 'react-router-dom';
import { useStoreActions } from 'store';

import AppRouteContentWrapper from '../components/AppRouteContentWrapper';
import Dashboard from '../components/Dashboard';
import addCustomRoutes from './addCustomRoutes';
import useEntityMap from './useEntityMap';

export interface AppRoutesProps {
  apiSpec: ParsedApiSpecInterface;
}

export default function AppRoutes(props: AppRoutesProps) {
  const { apiSpec } = props;

  const setRoutes = useStoreActions((actions) => actions.routes.setRoutes);
  const entityMap = useEntityMap();
  const baseUrl = process.env.BASE_URL;

  const routes = useMemo<RouteObject[]>(() => {
    return [];
    // eslint-disable-next-line react-hooks/exhaustive-deps
  }, [entityMap]);

  routes.push({
    path: baseUrl,
    element: (
      <AppRouteContentWrapper loggedIn={true} routeMap={entityMap}>
        <Dashboard />
      </AppRouteContentWrapper>
    ),
  });

  const routeSpecs = addCustomRoutes(parseRoutes(apiSpec, entityMap));

  routeSpecs.map((route: RouteSpec) => {
    routes.push({
      path: baseUrl + route.path.substring(1),
      element: (
        <AppRouteContentWrapper loggedIn={true} routeMap={entityMap}>
          <RouteContent route={route} routeMap={entityMap} {...props} />
        </AppRouteContentWrapper>
      ),
    });
  });

  if (routeSpecs.length === 0) {
    // Avoid warnings while routes are being parsed
    routes.push({
      path: '*',
      element: <div />,
    });
  }

  useEffect(() => {
    setRoutes(routes);
  }, [setRoutes, routes]);

  return useRoutes(routes);
}
