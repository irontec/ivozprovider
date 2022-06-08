import parseRoutes, { RouteSpec } from "@irontec/ivoz-ui/router/parseRoutes";
import RouteContent from "@irontec/ivoz-ui/router/RouteContent";
import ParsedApiSpecInterface from "@irontec/ivoz-ui/services/api/ParsedApiSpecInterface";
import Dashboard from "@irontec/ivoz-ui/components/Dashboard";
import Login from "components/Login";
import { Route, Switch } from "react-router-dom";
import AppRouteContentWrapper from "./AppRouteContentWrapper";
import getEntityMap from "./EntityMap";
import { AboutMe } from 'store/clientSession/aboutMe';
import useAclFilteredEntityMap from './useAclFilteredEntityMap';

export interface AppRoutesProps {
  token: string,
  apiSpec: ParsedApiSpecInterface,
  aboutMe: AboutMe | null,
}

export default function AppRoutes(props: AppRoutesProps): JSX.Element {
  const { token, apiSpec, aboutMe } = props;

  const aclFilteredEntityMap = useAclFilteredEntityMap({
    entityMap: getEntityMap(),
    aboutMe,
  });

  const routes = aboutMe
    ? parseRoutes(apiSpec, aclFilteredEntityMap)
    : [];

  if (!token || !aboutMe) {
    return <Login />;
  }

  const resp = (
    <Switch>
      <Route exact key="login" path="/">
        <AppRouteContentWrapper loggedIn={!!token} routeMap={aclFilteredEntityMap}>
          <Dashboard routeMap={aclFilteredEntityMap} />
        </AppRouteContentWrapper>
      </Route>
      {routes.map((route: RouteSpec) => (
        <Route exact key={route.key} path={route.path}>
          <AppRouteContentWrapper loggedIn={!!token} routeMap={aclFilteredEntityMap}>
            <RouteContent route={route} routeMap={aclFilteredEntityMap} {...props} />
          </AppRouteContentWrapper>
        </Route>
      ))}
    </Switch>
  );

  return resp;
}
