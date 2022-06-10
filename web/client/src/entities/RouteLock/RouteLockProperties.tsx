import { PropertySpec } from "@irontec/ivoz-ui/services/api/ParsedApiSpecInterface";
import {
  EntityValue,
  EntityValues,
} from "@irontec/ivoz-ui/services/entity/EntityService";

export type RouteLockPropertyList<T> = {
  status?: T;
  name?: T;
  description?: T;
  open?: T;
  closeExtension?: T;
  openExtension?: T;
  toggleExtension?: T;
};

export type RouteLockProperties = RouteLockPropertyList<Partial<PropertySpec>>;
export type RouteLockPropertiesList = Array<
  RouteLockPropertyList<EntityValue | EntityValues>
>;
