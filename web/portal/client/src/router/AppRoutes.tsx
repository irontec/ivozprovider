import AppRouteContentWrapper from '@irontec/ivoz-ui/components/AppRouteContentWrapper';
import Dashboard from '@irontec/ivoz-ui/components/Dashboard';
import parseRoutes, { RouteSpec } from '@irontec/ivoz-ui/router/parseRoutes';
import RouteContent from '@irontec/ivoz-ui/router/RouteContent';
import ParsedApiSpecInterface from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import { useEffect, useMemo } from 'react';
import { RouteObject, useRoutes } from 'react-router-dom';
import { useStoreActions } from 'store';

import addCustomRoutes from './addCustomRoutes';
import useEntityMap from './useEntityMap';

export interface AppRoutesProps {
  apiSpec: ParsedApiSpecInterface;
}

export default function AppRoutes(props: AppRoutesProps) {
  const { apiSpec } = props;

  const setRoutes = useStoreActions((actions) => actions.routes.setRoutes);
  const aclFilteredEntityMap = useEntityMap();
  const baseUrl = process.env.BASE_URL;

  const routes = useMemo<RouteObject[]>(() => {
    return [];
    // eslint-disable-next-line react-hooks/exhaustive-deps
  }, [aclFilteredEntityMap]);

  routes.push({
    path: baseUrl,
    element: (
      <AppRouteContentWrapper loggedIn={true} routeMap={aclFilteredEntityMap}>
        <Dashboard routeMap={aclFilteredEntityMap} />
      </AppRouteContentWrapper>
    ),
  });

  const routeSpecs = addCustomRoutes(
    parseRoutes(apiSpec, aclFilteredEntityMap)
  );

  routeSpecs.map((route: RouteSpec) => {
    routes.push({
      path: baseUrl + route.path.substring(1),
      element: (
        <AppRouteContentWrapper loggedIn={true} routeMap={aclFilteredEntityMap}>
          <RouteContent
            route={route}
            routeMap={aclFilteredEntityMap}
            {...props}
          />
        </AppRouteContentWrapper>
      ),
    });
  });

  useEffect(() => {
    setRoutes(routes);
  }, [setRoutes, routes]);

  return useRoutes(routes);
}
