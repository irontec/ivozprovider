import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec/ivoz-ui/services/entity/EntityService';

export type RoutingTagPropertyList<T> = {
  name?: T;
  tag?: T;
  id?: T;
};

export type RoutingTagProperties = RoutingTagPropertyList<
  Partial<PropertySpec>
>;
export type RoutingTagPropertiesList = Array<
  RoutingTagPropertyList<EntityValue | EntityValues>
>;
