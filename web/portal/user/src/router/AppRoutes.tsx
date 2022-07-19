import { Edit } from '@irontec/ivoz-ui';
import Dashboard from '@irontec/ivoz-ui/components/Dashboard';
import parseRoutes, { RouteSpec } from '@irontec/ivoz-ui/router/parseRoutes';
import RouteContent from '@irontec/ivoz-ui/router/RouteContent';
import ParsedApiSpecInterface from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import Login from 'components/Login';
import { Route, Switch } from 'react-router-dom';
import { useStoreState } from 'store';
import AppRouteContentWrapper from './AppRouteContentWrapper';
import getEntityMap from './EntityMap';

export interface AppRoutesProps {
  apiSpec: ParsedApiSpecInterface;
}

export default function AppRoutes(props: AppRoutesProps): JSX.Element {
  const { apiSpec } = props;

  const loggedIn = useStoreState((state) => state.auth.loggedIn);

  const entityMap = getEntityMap();

  if (!loggedIn) {
    return <Login />;
  }

  const routes = parseRoutes(apiSpec, entityMap).filter((route) => {
    if (route.key === 'User-list') {
      route.component = Edit;
    }
    return true;
  });

  return (
    <Switch>
      <Route exact key="login" path="/">
        <AppRouteContentWrapper loggedIn={loggedIn} routeMap={entityMap}>
          <Dashboard routeMap={entityMap} />
        </AppRouteContentWrapper>
      </Route>
      {routes.map((route: RouteSpec) => (
        <Route exact key={route.key} path={route.path}>
          <AppRouteContentWrapper loggedIn={loggedIn} routeMap={entityMap}>
            <RouteContent route={route} routeMap={entityMap} {...props} />
          </AppRouteContentWrapper>
        </Route>
      ))}
    </Switch>
  );
}
