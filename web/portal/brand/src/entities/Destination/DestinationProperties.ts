import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import { EntityValue, EntityValues } from '@irontec/ivoz-ui/services/entity/EntityService';

export type DestinationPropertyList<T> = {
  prefix?: T;
  id?: T;
  name?: T;
};

export type DestinationProperties = DestinationPropertyList<Partial<PropertySpec>>;
export type DestinationPropertiesList = Array<DestinationPropertyList<EntityValue | EntityValues>>;
