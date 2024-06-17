import AppRouteContentWrapper from '@irontec-voip/ivoz-ui/components/AppRouteContentWrapper';
import parseRoutes, {
  RouteSpec,
} from '@irontec-voip/ivoz-ui/router/parseRoutes';
import RouteContent from '@irontec-voip/ivoz-ui/router/RouteContent';
import ParsedApiSpecInterface from '@irontec-voip/ivoz-ui/services/api/ParsedApiSpecInterface';
import { useEffect, useMemo } from 'react';
import { RouteObject, useRoutes } from 'react-router-dom';
import { useStoreActions } from 'store';

import Dashboard from '../components/Dashboard/Dashboard.styles';
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
        <Dashboard />
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
