import { Switch, Route } from "react-router-dom";

import Login from 'components/Login';
import parseRoutes, { RouteSpec } from '@irontec/ivoz-ui/router/parseRoutes';
import entityMap from "./EntityMap";
import ParsedApiSpecInterface from "@irontec/ivoz-ui/services/api/ParsedApiSpecInterface";
import RouteContent from "@irontec/ivoz-ui/router/RouteContent";
import AppRouteContentWrapper from "./AppRouteContentWrapper";
import Dashboard from "components/Dashboard";

export interface AppRoutesProps {
  token: string,
  apiSpec: ParsedApiSpecInterface,
}

export default function AppRoutes(props: AppRoutesProps): JSX.Element {

  const { token, apiSpec } = props;

  if (!token) {
    return (<Login />);
  }

  const resp = (
    <Switch>
      <Route exact key='login' path='/'>
        <AppRouteContentWrapper loggedIn={!!token} routeMap={entityMap}>
          <Dashboard />
        </AppRouteContentWrapper>
      </Route>
      {token && parseRoutes(apiSpec, entityMap).map((route: RouteSpec) => (
        <Route exact key={route.key} path={route.path}>
          <AppRouteContentWrapper loggedIn={!!token} routeMap={entityMap}>
            <RouteContent route={route} routeMap={entityMap} {...props} />
          </AppRouteContentWrapper>
        </Route>
      ))}
    </Switch>
  );

  return resp;
}
