import { Switch, Route } from "react-router-dom";

import Dashboard from './Dashboard.styles';
import { Login } from 'lib/components';
import EntityService from "lib/services/entity/EntityService";
import parseRoutes, { RouteSpec } from 'lib/router/parseRoutes';
import { useStoreActions } from "store";
import { useEffect } from "react";
import entities from "../entities";
import ParsedApiSpecInterface from "lib/services/api/ParsedApiSpecInterface";

export interface AppRoutesProps {
  token: string,
  apiSpec: ParsedApiSpecInterface
}

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
      {token && parseRoutes(apiSpec, entities).map((route: RouteSpec) => (
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
  const title = route.entity.title;
  useEffect(
    () => {
      setRoute(path);
      setRouteName(title);
    },
    [path, title, setRoute, setRouteName]
  );

  const entity = route.entity;
  const entityService = new EntityService(
    apiSpec[entity.iden].actions,
    apiSpec[entity.iden].properties,
    entity
  );

  const properties = entityService.getProperties();

  return (<route.component {...entity} entityService={entityService} properties={properties} />);
};