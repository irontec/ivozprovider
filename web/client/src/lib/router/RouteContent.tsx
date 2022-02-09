import EntityService from "../services/entity/EntityService";
import ParsedApiSpecInterface from "../services/api/ParsedApiSpecInterface";
import { RouteSpec } from "./parseRoutes";
import { RouteMap } from "./routeMapParser";

export interface RouteContentProps {
  route: RouteSpec,
  apiSpec: ParsedApiSpecInterface,
  routeMap: RouteMap,
}

const RouteContent = (props: RouteContentProps): JSX.Element => {

  const { route, apiSpec, routeMap } = props;

  const entity = route.entity;
  const entityService = new EntityService(
    apiSpec[entity.iden].actions,
    apiSpec[entity.iden].properties,
    entity
  );

  const properties = entityService.getProperties();

  return (
    <route.component
      {...entity}
      entityService={entityService}
      routeMap={routeMap}
      properties={properties}
    />
  );
};

export default RouteContent;