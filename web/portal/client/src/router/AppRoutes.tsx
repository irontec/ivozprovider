import Dashboard from '@irontec/ivoz-ui/components/Dashboard';
import parseRoutes, { RouteSpec } from '@irontec/ivoz-ui/router/parseRoutes';
import RouteContent from '@irontec/ivoz-ui/router/RouteContent';
import ParsedApiSpecInterface from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import Login from 'components/Login';
import { Route, Switch } from 'react-router-dom';
import { useStoreState } from 'store';
import addCustomRoutes from './addCustomRoutes';
import AppRouteContentWrapper from './AppRouteContentWrapper';
import useEntityMap from './useEntityMap';
export interface AppRoutesProps {
  apiSpec: ParsedApiSpecInterface;
}

export default function AppRoutes(props: AppRoutesProps): JSX.Element {
  const { apiSpec } = props;

  const loggedIn = useStoreState((state) => state.auth.loggedIn);
  const aboutMe = useStoreState((state) => state.clientSession.aboutMe.profile);

  const aclFilteredEntityMap = useEntityMap();

  if (!loggedIn || !aboutMe) {
    return <Login />;
  }

  const routes = addCustomRoutes(parseRoutes(apiSpec, aclFilteredEntityMap));

  return (
    <Switch>
      <Route exact key="login" path="/">
        <AppRouteContentWrapper
          loggedIn={loggedIn}
          routeMap={aclFilteredEntityMap}
        >
          <Dashboard routeMap={aclFilteredEntityMap} />
        </AppRouteContentWrapper>
      </Route>
      {routes.map((route: RouteSpec) => (
        <Route exact key={route.key} path={route.path}>
          <AppRouteContentWrapper
            loggedIn={loggedIn}
            routeMap={aclFilteredEntityMap}
          >
            <RouteContent
              route={route}
              routeMap={aclFilteredEntityMap}
              {...props}
            />
          </AppRouteContentWrapper>
        </Route>
      ))}
    </Switch>
  );
}
