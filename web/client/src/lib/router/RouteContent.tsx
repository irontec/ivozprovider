import EntityService from "../services/entity/EntityService";
import ParsedApiSpecInterface from "../services/api/ParsedApiSpecInterface";
import { RouteSpec } from "./parseRoutes";

export interface RouteContentProps {
  route: RouteSpec,
  apiSpec: ParsedApiSpecInterface
}

const RouteContent = (props: RouteContentProps): JSX.Element => {

  const { route, apiSpec } = props;

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
      properties={properties}
    />
  );
};

export default RouteContent;