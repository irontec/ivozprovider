import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import { EntityValue, EntityValues } from '@irontec/ivoz-ui/services/entity/EntityService';

export type RoutingPatternPropertyList<T> = {
  prefix?: T;
  id?: T;
  name?: T;
  description?: T;
};

export type RoutingPatternProperties = RoutingPatternPropertyList<Partial<PropertySpec>>;
export type RoutingPatternPropertiesList = Array<RoutingPatternPropertyList<EntityValue | EntityValues>>;
