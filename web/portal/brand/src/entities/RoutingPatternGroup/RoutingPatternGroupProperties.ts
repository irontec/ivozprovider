import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import { EntityValue, EntityValues } from '@irontec/ivoz-ui/services/entity/EntityService';

export type RoutingPatternGroupPropertyList<T> = {
  name?: T;
  description?: T;
  id?: T;
  patternIds?: T;
};

export type RoutingPatternGroupProperties = RoutingPatternGroupPropertyList<Partial<PropertySpec>>;
export type RoutingPatternGroupPropertiesList = Array<RoutingPatternGroupPropertyList<EntityValue | EntityValues>>;
