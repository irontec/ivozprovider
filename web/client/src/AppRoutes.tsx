import { Switch, Route } from "react-router-dom";

import Dashboard from './Dashboard';
import { Login } from 'lib/components';
import EntityService from "lib/services/entity/EntityService";
import { RouteSpec, parseRoutes } from 'lib/entities/Routes';
import { useStoreActions } from "store";
import { useEffect } from "react";
import { AppRoutesProps } from "lib/App";

export default function AppRoutes(props: AppRoutesProps): JSX.Element {

  const { token, apiSpec } = props;

  if (!token) {
    return (<Login />);
  }

  return (
    <Switch>
      <Route exact key='login' path='/'>
        <DashboardRoute loggedIn={!!token} />
      </Route>
      {token && parseRoutes(apiSpec).map((route: RouteSpec) => (
        <Route exact key={route.key} path={route.path}>
          <RouteContent route={route} {...props} />
        </Route>
      ))}
    </Switch>
  );
}

const DashboardRoute = (props: any) => {
  const { loggedIn } = props;
  const setRoute = useStoreActions((actions: any) => {
    return actions.route.setRoute;
  });

  useEffect(
    () => {
      setRoute('/');
    },
    [setRoute]
  );

  return (<Dashboard loggedIn={loggedIn} />);
};

const RouteContent = (props: any) => {

  const { route, apiSpec } = props;
  const setRoute = useStoreActions((actions: any) => {
    return actions.route.setRoute;
  });
  const setRouteName = useStoreActions((actions: any) => {
    return actions.route.setName;
  });

  const path = route.path;
  useEffect(
    () => {
      setRoute(path);
      setRouteName(route.entity.title);
    },
    [path, route.entity.title, setRoute, setRouteName]
  );

  const entity = route.entity;
  const entityService = new EntityService(
    apiSpec[entity.iden].actions,
    apiSpec[entity.iden].properties,
    entity
  );

  return (<route.component entityService={entityService} {...entity} />);
};